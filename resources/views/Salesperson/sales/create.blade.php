@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Record new Sale') }}</div>
                <div class="card-body">
                    <form action="{{ route('sales.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <!-- Customer -->
                            <div class="col-md-6 mb-3">
                                <label for="customer_id" class="form-label">Customer</label>
                                <select name="customer_id" id="customer_id" class="form-select" required>
                                    @foreach ($users as $user)
                                        @if (!$user->hasRole('salesperson'))
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                    
                            <!-- Salesperson -->
                            <div class="col-md-6 mb-3">
                                <label for="salesperson_id" class="form-label">Salesperson</label>
                                <select name="salesperson_id" class="form-select" required>
                                    @foreach ($users as $user)
                                        @if (!$user->hasRole('customer'))
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                    
                            <!-- Car -->
                            <div class="col-md-6 mb-3">
                                <label for="car_id" class="form-label">Car</label>
                                <select name="car_id" id="car_id" class="form-select" required>
                                    <option value="" selected disabled>-- Select a Car --</option>
                                    @foreach ($sales as $sale)
                                        @if ($sale->car->status_id === 2)
                                            <option 
                                                value="{{ $sale->car->id }}" 
                                                data-price="{{ $sale->car->price }}">
                                                {{ $sale->car->brand . ' ' . $sale->car->model }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                    
                            <!-- Sale Price -->
                            <div class="col-md-6 mb-3">
                                <label for="sale_price" class="form-label">Sale Price (₱)</label>
                                <input type="text" name="sale_price" id="sale_price" class="form-control" readonly required>
                            </div>
                    
                            <!-- Sale Date -->
                            <div class="col-md-6 mb-3">
                                <label for="sale_date" class="form-label">Sale Date</label>
                                <input type="date" name="sale_date" id="sale_date" class="form-control" required>
                            </div>
                    
                            <!-- Payment Method -->
                            <div class="col-md-6 mb-3">
                                <label for="payment_method" class="form-label">Payment Method</label>
                                <select name="payment_method" id="payment_method" class="form-select" required>
                                    <option value="" selected disabled>-- Select Payment Method --</option>
                                    <option value="cash">Cash</option>
                                    <option value="card">Card</option>
                                </select>
                            </div>
                        </div>
                    
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('sales.index') }}" class="btn btn-secondary mt-2">Back</a>
                            <button type="submit" class="btn btn-success mt-2">Submit</button>
                        </div>
                    </form>            
                </div>
            </div>
        </div>
    </div>
</div> 
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const carSelect = document.getElementById('car_id');
        const priceInput = document.getElementById('sale_price');

        carSelect.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const price = selectedOption.getAttribute('data-price');
            priceInput.value = price ? parseFloat(price).toFixed(2) : '';
        });
    });
</script>
@endsection
