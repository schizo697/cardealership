<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CarImage;
use App\Models\Status;
use App\Models\CarList;
use App\Models\Sale;

class Car extends Model
{
    protected $fillable = [
        'serial_number',
        'brand',
        'model',
        'year',
        'price',
        'fuel_type',
        'transmission',
        'status_id',
        'description',
    ];

    public function image() {
        return $this->hasOne(CarImage::class);
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function listing() {
        return $this->hasMany(CarList::class);
    }

    public function sale() {
        return $this->hasMany(Sale::class);
    }
}
