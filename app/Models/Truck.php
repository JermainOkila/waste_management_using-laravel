<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    protected $fillable = [
        'plate_number', 'driver_name', 'driver_phone',
        'status', 'current_lat', 'current_lng',
    ];

    public function pickupRequests()
    {
        return $this->hasMany(PickupRequest::class);
    }

    public function dispatches()
    {
        return $this->hasMany(Dispatch::class);
    }
}