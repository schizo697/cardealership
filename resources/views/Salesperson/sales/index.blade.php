@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Car Lists') }}</div>
                <div class="card-body">
                    <a href="{{ route('sales.create') }}" class="btn btn-primary mb-2">New Sale</a>
                    <table class="table table-stripped table-bordered">
                        <thead>
                            <tr>
                                <th>Assigned Salesperson</th>
                                <th>Serial Number</th>
                                <th>Brand</th>
                                <th>Model</th>
                                <th>Price</th>
                                <th>Year</th>
                                <th>Fuel Type</th>
                                <th>Transmission</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sales as $sale)
                                @if ($sale->car->status_id === 2)
                                    <tr>
                                        <td>{{ $sale->user->name }}</td>
                                        <td>{{ $sale->car->serial_number }}</td>
                                        <td>{{ $sale->car->brand }}</td>
                                        <td>{{ $sale->car->model }}</td>
                                        <td>₱ {{ number_format($sale->car->price, 2, '.', ',') }}</td>
                                        <td>{{ $sale->car->year }}</td>
                                        <td>{{ $sale->car->fuel_type }}</td>
                                        <td>{{ $sale->car->transmission }}</td>
                                        <td>{{ $sale->car->description }}</td>
                                        <td>
                                            <img src="{{ asset($sale->car->image->path) }}" alt="{{ $sale->brand }} image" class="img-fluid" style="max-width: 50px;">
                                        </td>
                                        <td>{{ $sale->car->status->name }}</td>
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
