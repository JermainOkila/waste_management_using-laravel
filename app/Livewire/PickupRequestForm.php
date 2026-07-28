<?php

namespace App\Livewire;

use Livewire\Component;

class PickupRequestForm extends Component
{
    public string $pickup_address = '';
    public string $notes = '';

    protected function rules()
    {
        return [
            'pickup_address' => 'required|string|max:255',
            'notes' => 'nullable|string|max:500',
        ];
    }

    public function save()
{
    $validated = $this->validate();

    $existing = auth()->user()->pickupRequests()
        ->whereNotIn('status', ['picked_up', 'cancelled'])
        ->exists();

    if ($existing) {
        session()->flash('error', 'You already have an active request.');
        return;
    }

    auth()->user()->pickupRequests()->create([
        'pickup_address' => $validated['pickup_address'],
        'notes' => $validated['notes'] ?? null,
        'pickup_lat' => auth()->user()->latitude,
        'pickup_lng' => auth()->user()->longitude,
        'amount' => 200,
        'status' => 'pending_payment',
    ]);

    session()->flash('success', 'Request created, proceed to payment.');

    return $this->redirect(route('dashboard'), navigate: true);
}