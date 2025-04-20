@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Cars') }}</div>
                <div class="card-body">
                    <a href="{{ route('cars.create') }}" class="btn btn-primary mb-2">Create</a>
                    <table class="table table-stripped table-bordered">
                        <thead>
                            <tr>
                                <th>Serial Number</th>
                                <th>Brand</th>
                                <th>Model</th>
                                <th>Year</th>
                                <th>Price</th>
                                <th>Fuel Type</th>
                                <th>Transmission</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cars as $car)
                                <tr>
                                    <td>{{ $car->serial_number }}</td>
                                    <td>{{ $car->brand }}</td>
                                    <td>{{ $car->model }}</td>
                                    <td>{{ $car->year }}</td>
                                    <td>₱ {{ number_format($car->price, 2, '.', ',') }}</td>
                                    <td>{{ $car->fuel_type }}</td>
                                    <td>{{ $car->transmission }}</td>
                                    <td>{{ $car->description }}</td>
                                    <td>
                                        <img src="{{ asset($car->image->path) }}" alt="{{ $car->brand }} image" class="img-fluid" style="max-width: 50px;">
                                    </td>
                                    <td>{{ $car->status->name }}</td>
                                    <td>
                                        <form action="{{ route('cars.destroy', $car->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{route('cars.edit', $car->id)}}" class="btn btn-primary btn-sm">Edit</a>
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
