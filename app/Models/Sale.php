<?php

namespace App\Models;
use App\Models\Car;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'car_id',
        'customer_id',
        'salesperson_id',
        'sale_price',
        'sale_date',
        'payment_method',
        'total_amount',
        'status_id',
    ];

    public function car(){
        return $this->belongsTo(Car::class);
    }

    public function customer() {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function salesperson() {
        return $this->belongsTo(User::class, 'salesperson_id');
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }
}
