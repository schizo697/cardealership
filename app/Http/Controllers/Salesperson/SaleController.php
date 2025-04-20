<?php

namespace App\Http\Controllers\Salesperson;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarList;
use App\Models\Car;
use App\Models\User;
use App\Models\Sale;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = CarList::with('car')->get();
        return view('salesperson.sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sales = CarList::with('car')->get();
        $users = User::role(['customer' , 'salesperson'])->get();
        return view('salesperson.sales.create', compact('sales', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required',
            'customer_id' => 'required',
            'salesperson_id' => 'required',
            'sale_price' => 'required',
            'sale_date' => 'required',
            'payment_method' => 'required',
        ]);
        

        $vatRate = 0.12;
        $totalBeforeTax = $request->sale_price;

        if ($request->payment_method === 'cash') {
            $discount = $request->sale_price * 0.10;
            $totalBeforeTax -= $discount;
        } else { //card payment
            $fee = $request->sale_price * 0.05;
            $totalBeforeTax += $fee;
        }

        $vatAmount = $totalBeforeTax * $vatRate;
        $totalAmount = $totalBeforeTax + $vatAmount;

        $sale = Sale::create([
            'car_id' => $request->car_id,
            'customer_id' => $request->customer_id,
            'salesperson_id' => $request->salesperson_id,
            'sale_price' => $request->sale_price,
            'sale_date' => $request->sale_date,
            'payment_method' => $request->payment_method,
            'total_amount' => $totalAmount,
            'status_id' => 6,
        ]);

        if ($sale) {
            $car = Car::findOrFail($request->car_id);
            $car->status_id = 1;
            $car->save();
        }

        return redirect()->route('sales.index')->with('success', 'Sale recorded successfully.');
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
        //
    }
}
