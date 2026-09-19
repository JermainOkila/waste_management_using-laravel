<?php

namespace App\Livewire;

use App\Models\PickupRequest;
use Livewire\Component;

class MarkPickedUpButton extends Component
{
    public PickupRequest $pickupRequest;

    public function markPickedUp()
    {
        $this->pickupRequest->update([
            'status' => 'picked_up',
            'picked_up_at' => now(),
        ]);

        if ($this->pickupRequest->truck) {
            $this->pickupRequest->truck->update(['status' => 'available']);
        }

        session()->flash('success', 'Request marked as picked up.');

        return $this->redirect(route('admin.dashboard'));
    }

    public function render()
    {
        return view('livewire.mark-picked-up-button');
    }
}