<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Status;
use App\Models\CarImage;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::all();
        return view ("admin.cars.index", compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = Status::all();
        return view ("admin.cars.create", compact("statuses"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required',
            'model' => 'required',
            'year' => 'required',
            'price' => 'required|numeric',
            'fuel_type' => 'required',
            'transmission' => 'required',
            'status' => 'required',
            'description' => 'nullable|max:500',
            'car_img' => 'required|image|max:2048', // Added 'image' validation
        ]);
    
        //Generate serial number
        $latestCar = Car::orderBy('id', 'desc')->first();
        $nextId = $latestCar ? $latestCar->id + 1 : 1;
        $serialNumber = 'CAR-' . str_pad($nextId, 3, '0' , STR_PAD_LEFT);

        // Create the car first and store it in a variable
        $car = Car::create([
            "serial_number" => $serialNumber,
            "brand" => $request->brand,
            "model" => $request->model,
            "year" => $request->year,
            "price" => $request->price,
            "fuel_type" => $request->fuel_type,
            "transmission" => $request->transmission,
            "status_id" => $request->status,
            "description" => $request->description,
        ]);
    
        // Initialize imagePath as null in case no image is uploaded
        $imagePath = null;
    
        // Handle image upload
        if ($request->hasFile('car_img')) {
            $image = $request->file('car_img');
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            // Store the image in the storage/app/public/cars directory
            $imagePath = $image->storeAs('cars', $imageName, 'public');
            
            // Create the car image record with the correct path
            CarImage::create([
                'car_id' => $car->id,
                'path' => 'storage/' . $imagePath, // The path should be accessible from public
            ]);
        }
    
        return redirect()->route("cars.index")->with("success", "Car created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cars = Car::findOrFail($id);
        $statuses = Status::all();
        return view("admin.cars.edit", compact("cars", "statuses"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'brand' => 'required',
            'model' => 'required',
            'year' => 'required|date',
            'price' => 'required|numeric',
            'fuel_type' => 'required',
            'transmission' => 'required',
            'status' => 'required',
            'description' => 'nullable|max:500',
            'car_img' => 'nullable|image|max:2048', // made optional on update
        ]);
    
        $car = Car::findOrFail($id);
        $car->brand = $request->brand;
        $car->model = $request->model;
        $car->year = $request->year;
        $car->price = $request->price;
        $car->fuel_type = $request->fuel_type;
        $car->transmission = $request->transmission;
        $car->status_id = $request->status;
        $car->description = $request->description;
        $car->save();
    
        // Handle image upload if present
        if ($request->hasFile('car_img')) {
            $image = $request->file('car_img');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('cars', $imageName, 'public');
    
            // Either update existing CarImage or create a new one
            $carImage = CarImage::where('car_id', $id)->first();
            if ($carImage) {
                $carImage->path = 'storage/' . $imagePath;
                $carImage->save();
            } else {
                CarImage::create([
                    'car_id' => $id,
                    'path' => 'storage/' . $imagePath,
                ]);
            }
        }
    
        return redirect()->route('cars.index')->with('success', 'Car updated successfully');
    }    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $car = Car::find($id);
        $car->delete();
        return redirect()->route("cars.index")->with("success", "Car deleted successfully");
    }
}
