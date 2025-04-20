@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Cars') }}</div>
                <div class="card-body">
                    <form action="{{ route('cars.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="brand">Brand:</label>
                                <input type="text" name="brand" id="brand" class="form-control">
                                @error('brand')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="model">Model:</label>
                                <input type="text" name="model" id="model" class="form-control">
                                @error('model')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="year">Year:</label>
                                <input type="date" name="year" id="year" class="form-control">
                                @error('year')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="price">Price:</label>
                                <input type="number" name="price" id="price" class="form-control">
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="fuel_type">Fuel Type:</label>
                                <select class="form-select" name="fuel_type" id="fuel_type">
                                    <option value="" selected disabled>-- Select Fuel Type --</option>
                                    <option value="Petrol">Petrol</option>
                                    <option value="Diesel">Diesel</option>
                                    <option value="Electric">Electric</option>
                                </select>
                                @error('fuel_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="transmission">Transmission:</label>
                                <select class="form-select" name="transmission" id="transmission">
                                    <option value="" selected disabled>-- Select Transmission --</option>
                                    <option value="Manual">Manual</option>
                                    <option value="Automatic">Automatic</option>
                                </select>
                                @error('transmission')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="status">Status:</label>
                                <select class="form-select" name="status" id="status">
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status->id }}" {{ $status->name == 'Available' ? 'selected' : ''  }}>{{ $status->name }}</option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6  mb-3">
                                <label for="car_img">Image:</label>
                                <input class="form-control" type="file" name="car_img" id="car_img" accept=".jpg, .jpeg, .png">
                                @error('car_img')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description">Description:</label>
                                <textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('cars.index') }}" class="btn btn-secondary mt-2">back</a>
                            <button type="submit" class="btn btn-success mt-2">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
