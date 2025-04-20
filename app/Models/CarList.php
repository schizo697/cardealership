<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Car;
use App\Models\User;

class CarList extends Model
{
    protected $fillable = [
        'car_id',
        'user_id'
    ];

    public function car() {
        return $this->belongsTo(Car::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
