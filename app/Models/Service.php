<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'service_ticket',
        'user_id',
        'customer_name',
        'car',
        'service',
        'price',
        'assigned_mechanic',
        'status_id',
    ];

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}
