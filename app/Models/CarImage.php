<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Car;

class CarImage extends Model
{
    protected $fillable = [
        'car_id',
        'path'
    ];

    public function car() {
        return $this->belongsTo(Car::class);
    }

}
