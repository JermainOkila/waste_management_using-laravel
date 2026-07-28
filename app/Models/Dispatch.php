<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dispatch extends Model
{
    protected $fillable = [
        'pickup_request_id', 'truck_id', 'dispatched_by', 'dispatched_at',
    ];

    public function pickupRequest()
    {
        return $this->belongsTo(PickupRequest::class);
    }

    public function truck()
    {
        return $this->belongsTo(Truck::class);
    }

    public function dispatcher()
    {
        return $this->belongsTo(User::class, 'dispatched_by');
    }
}
