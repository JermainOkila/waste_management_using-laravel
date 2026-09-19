<?php

namespace App\Livewire;

use App\Notifications\TruckDispatched;
use App\Models\Dispatch;
use App\Models\PickupRequest;
use App\Models\Truck;
use Livewire\Component;

class DispatchButton extends Component
{
    public PickupRequest $pickupRequest;

    public string $selectedTruckId = '';

    public function getAvailableTrucksProperty()
    {
        return Truck::where('status', 'available')->get();
    }

    public function assignTruck()
    {
        $this->validate([
            'selectedTruckId' => 'required|exists:trucks,id',
        ]);

        Dispatch::create([
            'pickup_request_id' => $this->pickupRequest->id,
            'truck_id' => $this->selectedTruckId,
            'dispatched_by' => auth()->id(),
            'dispatched_at' => now(),
        ]);

        $this->pickupRequest->update([
            'status' => 'dispatched',
            'truck_id' => $this->selectedTruckId,
        ]);
        $this->pickupRequest->user->notify(new TruckDispatched($this->pickupRequest));

        Truck::where('id', $this->selectedTruckId)->update(['status' => 'on_route']);

        session()->flash('success', 'Truck dispatched successfully.');

        return $this->redirect(route('admin.dashboard'));
    }

    public function render()
    {
        return view('livewire.dispatch-button');
    }
}

