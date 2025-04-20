@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Car Services') }}</div>
                <div class="card-body">
                    <a href="{{ route('services.create') }}" class="btn btn-primary mb-2">Create</a>
                    <table class="table table-stripped table-bordered">
                        <thead>
                            <tr>
                                <th>Services Ticket</th>
                                <th>Customer</th>
                                <th>Car</th>
                                <th>Services</th>
                                <th>Price</th>
                                <th>Assigned Mechanic</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $service)
                                <tr>
                                    <td>{{ $service->service_ticket }}</td>
                                    <td>
                                        {{ $service->user_id ? $service->user->name : $service->customer_name }}
                                    </td>                                    
                                    <td>{{ $service->car }}</td>
                                    <td>{{ $service->service }}</td>
                                    <td>₱ {{ number_format($service->price, 2, '.', ',') }}</td>
                                    <td>
                                        @php
                                            $mechanicIds = explode(',', $service->assigned_mechanic);
                                            $mechanics = \App\Models\User::whereIn('id', $mechanicIds)->get();
                                        @endphp
                                    
                                        @foreach ($mechanics as $index => $mechanic)
                                            {{ $mechanic->name }}@if (!$loop->last), @endif
                                        @endforeach
                                    </td>                                    
                                    <td>{{ $service->status->name }}</td>
                                    <td>
                                        <form action="{{ route('services.destroy', $service->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{route('services.edit', $service->id)}}" class="btn btn-primary btn-sm">Edit</a>
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
