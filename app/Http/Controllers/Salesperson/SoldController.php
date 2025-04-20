<?php

namespace App\Http\Controllers\Salesperson;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarList;
use App\Models\Car;
use App\Models\User;
use App\Models\Sale;

class SoldController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::with('car')->get();
        return view('salesperson.solds.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sales = Sale::findOrFail($id);
        $cars = Car::findOrFail($sales->car_id);
        $customer = User::findOrFail($sales->customer_id);
        $salesperson = User::findOrFail($sales->salesperson_id);
    
        $price = floatval($sales->sale_price);
        $vatRate = 0.12;
        $discount = 0;
        $fee = 0;
    
        $totalBeforeTax = $price;
    
        if ($sales->payment_method === 'cash') {
            $discount = $price * 0.10;
            $totalBeforeTax -= $discount;
        } else { // card payment
            $fee = $price * 0.05;
            $totalBeforeTax += $fee;
        }
    
        $vatAmount = $totalBeforeTax * $vatRate;
        $totalAmount = $totalBeforeTax + $vatAmount;
    
        return view('salesperson.solds.show', compact(
            'sales', 
            'cars', 
            'customer', 
            'salesperson',
            'price',
            'discount',
            'fee',
            'totalBeforeTax',
            'vatAmount',
            'totalAmount'
        ));
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
