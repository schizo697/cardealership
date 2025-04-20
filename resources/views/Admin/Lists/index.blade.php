@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Car Lists') }}</div>
                <div class="card-body">
                    <a href="{{ route('lists.create') }}" class="btn btn-primary mb-2">Create</a>
                    <table class="table table-stripped table-bordered">
                        <thead>
                            <tr>
                                <th>Assigned Salesperson</th>
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
                            @foreach ($lists as $list)
                                <tr>
                                    <td>{{ $list->user->name }}</td>
                                    <td>{{ $list->car->serial_number }}</td>
                                    <td>{{ $list->car->brand }}</td>
                                    <td>{{ $list->car->model }}</td>
                                    <td>₱ {{ number_format($list->car->price, 2, '.', ',') }}</td>
                                    <td>{{ $list->car->year }}</td>
                                    <td>{{ $list->car->fuel_type }}</td>
                                    <td>{{ $list->car->transmission }}</td>
                                    <td>{{ $list->car->description }}</td>
                                    <td>
                                        <img src="{{ asset($list->car->image->path) }}" alt="{{ $list->brand }} image" class="img-fluid" style="max-width: 50px;">
                                    </td>
                                    <td>{{ $list->car->status->name }}</td>
                                    <td>
                                        <form action="{{ route('lists.destroy', $list->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
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
