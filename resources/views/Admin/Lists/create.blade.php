@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('List Cars') }}</div>
                <div class="card-body">
                    <form action="{{ route('lists.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-3">
                                <label for="brand">Car:</label>
                                <select class="form-select" name="brand" id="brand" onchange="showCarDetails(this)">
                                    <option value="" selected disabled>-- Select Car --</option>
                                    @foreach ($cars as $car)
                                        @if ($car->status_id === 2)
                                            <option value="{{ $car->id }}" data-brand="{{ $car->brand }}" data-model="{{ $car->model }}" data-year="{{ $car->year }}" 
                                                data-price="{{ $car->price }}" data-fuel="{{ $car->fuel_type }}" data-transmission="{{ $car->transmission }}" data-image="{{ asset($car->image->path) }}">
                                                {{ $car->brand . ' ' . $car->model}} 
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('brand')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="user_id">Assign Salesperson:</label>
                                <select class="form-select" name="user_id" id="user_id">
                                    <option value="" selected disabled>-- Select Salesperson --</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Car details section -->
                            <div class="col-md-6 mb-4 text-center" id="car-details" style="display:none;">
                                <h4>Car Details</h4>
                                <div class="row">
                                    <div class="col-md-6 text-start mb-2">
                                        <strong>Brand:</strong>
                                    </div>
                                    <div class="col-md-6 text-end mb-2" id="car-brand"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 text-start mb-2">
                                        <strong>Model:</strong>
                                    </div>
                                    <div class="col-md-6 text-end mb-2" id="car-model"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 text-start mb-2">
                                        <strong>Year:</strong>
                                    </div>
                                    <div class="col-md-6 text-end mb-2" id="car-year"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 text-start mb-2">
                                        <strong>Price:</strong>
                                    </div>
                                    <div class="col-md-6 text-end mb-2" id="car-price"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 text-start mb-2">
                                        <strong>Fuel Type:</strong>
                                    </div>
                                    <div class="col-md-6 text-end mb-2" id="car-fuel"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 text-start mb-2">
                                        <strong>Transmission:</strong>
                                    </div>
                                    <div class="col-md-6 text-end mb-2" id="car-transmission"></div>
                                </div>
                            </div>                            
                            <div class="col-md-6 mb-3" id="car-image-container" style="display:none;">
                                <img src="" alt="Car Image" id="car-image" class="img-fluid" style="max-width: 400px;">
                            </div>
                        </div>
                    
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('lists.index') }}" class="btn btn-secondary mt-2">Back</a>
                            <button type="submit" class="btn btn-success mt-2">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function showCarDetails(selectElement) {
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var brand = selectedOption.getAttribute('data-brand');
        var model = selectedOption.getAttribute('data-model');
        var year = selectedOption.getAttribute('data-year');
        var price = selectedOption.getAttribute('data-price');
        var fuel = selectedOption.getAttribute('data-fuel');
        var transmission = selectedOption.getAttribute('data-transmission');
        var carImage = selectedOption.getAttribute('data-image');

        document.getElementById('car-brand').textContent = brand;
        document.getElementById('car-model').textContent = model;
        document.getElementById('car-year').textContent = year;
        document.getElementById('car-price').textContent = price;
        document.getElementById('car-fuel').textContent = fuel;
        document.getElementById('car-transmission').textContent = transmission;
        document.getElementById('car-image').setAttribute('src', carImage);

        document.getElementById('car-details').style.display = 'block';
        document.getElementById('car-image-container').style.display = 'block';
    }
</script>
@endsection
