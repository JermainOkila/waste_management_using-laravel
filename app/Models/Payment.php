<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'pickup_request_id', 'user_id', 'phone', 'amount',
        'checkout_request_id', 'mpesa_receipt', 'status',
    ];

    public function pickupRequest()
    {
        return $this->belongsTo(PickupRequest::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
