@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Car Lists') }}</div>
                <div class="card-body">
                    <div id="payslip" class="container mt-5 mb-2">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="text-center lh-1 mb-2">
                                            <h6 class="fw-bold">Invoice #: {{ $sales->id }}</h6> <span class="fw-normal">Date: {{$sales->sale_date}}</span>
                                        </div>
                                            <div class="d-flex justify-content-end"> <span>Car Dealership</span> </div>
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div> <span class="fw-bolder">Salesperson:</span> <small class="ms-3">{{ $salesperson->name }}</small> </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div> <span class="fw-bolder">Customer:</span> <small class="ms-3">{{ $customer->name }}</small> </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div> <span class="fw-bolder">Payment Status:</span> <small class="ms-3">{{ $sales->status->name }}</small> </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div> <span class="fw-bolder">Car Deatails:</span> <small class="ms-3">{{ $sales->car->brand . ' ' . $sales->car->model }}</small> </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div> <span class="fw-bolder">Payment Method:</span> <small class="ms-3">{{ $sales->payment_method }}</small> </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if ($sales->payment_method === 'cash')
                                                <table class="mt-4 table table-bordered">
                                                    <thead class="bg-dark text-white">
                                                        <tr>
                                                            <th scope="col">Details</th>
                                                            <th scope="col">Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">Car Price</th>
                                                            <td>₱ {{ number_format($sales->car->price, 2, '.', ',') }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Cash Payment Discount</th>
                                                            <td>₱ {{ number_format($discount, 2, '.', ',') }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">VAT</th>
                                                            <td>₱ {{ number_format($vatAmount, 2, '.', ',') }}</td>
                                                        </tr>
                                                        <tr class="border-top">
                                                            <th scope="row">Total Amount</th>
                                                            <td>₱ {{ number_format($totalAmount, 2, '.', ',') }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                @else
                                                    <table class="mt-4 table table-bordered">
                                                        <thead class="bg-dark text-white">
                                                            <tr>
                                                                <th scope="col">Details</th>
                                                                <th scope="col">Amount</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row">Car Price</th>
                                                                <td>₱ {{ number_format($sales->car->price, 2, '.', ',') }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Card Payment Fee</th>
                                                                <td>₱ {{ number_format($fee, 2, '.', ',') }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">VAT</th>
                                                                <td>₱ {{ number_format($vatAmount, 2, '.', ',') }}</td>
                                                            </tr>
                                                            <tr class="border-top">
                                                                <th scope="row">Total Amount</th>
                                                                <td>₱ {{ number_format($totalAmount, 2, '.', ',') }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                @endif

                                                
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <div class="d-flex flex-column mt-2"> 
                                                <span class="fw-bold">Thanks for purchasing</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection