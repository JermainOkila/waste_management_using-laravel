<?php

namespace App\Notifications;

use App\Models\PickupRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class TruckDispatched extends Notification
{
    use Queueable;

    public function __construct(public PickupRequest $pickupRequest)
    {
        //
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'pickup_request_id' => $this->pickupRequest->id,
            'message' => "A truck ({$this->pickupRequest->truck->plate_number}) has been dispatched to {$this->pickupRequest->pickup_address}.",
        ];
    }
}