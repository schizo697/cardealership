<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarList;
use App\Models\Car;
use App\Models\User;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lists = CarList::with('car')->get();
        return view('admin.lists.index', compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cars = Car::all();
        $users = User::role('salesperson')->get();
        return view('admin.lists.create', compact('cars', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required',
            'user_id' => 'required',
        ]);
        
        $listExist = CarList::where('car_id', $request->brand)->first();
        if ($listExist) {
            return redirect()->route("lists.index")->with("error", "This car is already listed!");
        }

        $list = CarList::create([
            'car_id' => $request->brand,
            'user_id' => $request->user_id
        ]);

        return redirect()->route("lists.index")->with("success", "Car listed successfully");
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $list = CarList::find($id);
        $list->delete();
        return redirect()->route("lists.index")->with("success", "Car deleted successfully");
    }
}
