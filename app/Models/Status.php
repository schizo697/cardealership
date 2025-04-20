<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Car;
use App\Models\Service;
use App\Models\Sale;

class Status extends Model
{
    protected $fillable = ['name'];

    public function cars() {
        return $this->hasMany(Car::class);
    }

    public function services() {
        return $this->hasMany(Service::class);
    }

    public function sale() {
        return $this->hasMany(Sale::class);
    }
}
