<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PickupRequest extends Model
{
    protected $fillable = [
        'user_id', 'truck_id', 'notes', 'pickup_address',
        'pickup_lat', 'pickup_lng', 'amount', 'status',
        'dispatched_at', 'picked_up_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function truck()
    {
        return $this->belongsTo(Truck::class);
    }
}
