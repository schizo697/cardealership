@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Car Lists') }}</div>
                <div class="card-body">
                    <a href="{{ route('solds.create') }}" class="btn btn-primary mb-2">New Sale</a>
                    <table class="table table-stripped table-bordered">
                        <thead>
                            <tr>
                                <th>Assigned Salesperson</th>
                                <th>Customer</th>
                                <th>Serial Number</th>
                                <th>Model</th>
                                <th>Price</th>
                                <th>Date of sale</th>
                                <th>Payment Method</th>
                                <th>Total Amount</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sales as $sale)
                                @if ($sale->status_id === 6)
                                    <tr>
                                        <td>{{ $sale->salesperson->name }}</td>
                                        <td>{{ $sale->customer->name }}</td>
                                        <td>{{ $sale->car->serial_number }}</td>
                                        <td>{{ $sale->car->brand . ' ' . $sale->car->model }}</td>
                                        <td>₱ {{ number_format($sale->car->price, 2, '.', ',') }}</td>
                                        <td>{{ $sale->car->year }}</td>
                                        <td>{{ $sale->payment_method     }}</td>
                                        <td>{{ $sale->car->transmission }}</td>
                                        <td>
                                            <img src="{{ asset($sale->car->image->path) }}" alt="{{ $sale->brand }} image" class="img-fluid" style="max-width: 50px;">
                                        </td>
                                        <td>{{ $sale->status->name }}</td>
                                        <td>
                                            <a href="{{ route('solds.show', $sale->id) }}" class="btn btn-info btn-sm">Generate Invoice</a>
                                        </td>
                                    </tr>
                                @endif
                                @empty($sale)
                                    <tr>
                                        <td>
                                            <td colspan="11" class="text-center">No sales data available.</td>
                                        </td>
                                    </tr>
                                @endempty
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
