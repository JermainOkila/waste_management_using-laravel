<?php

namespace App\Livewire;

use App\Models\PickupRequest;
use Livewire\Component;

class PaymentButton extends Component
{
    public PickupRequest $pickupRequest;

    public bool $processing = false;

    public function pay()
    {
        $this->processing = true;

        // --- STUB: pretend M-Pesa STK push succeeded instantly ---
        // Real integration later replaces just this block with an
        // actual API call + a webhook callback that marks it paid.
        $this->pickupRequest->payments()->create([
            'user_id' => $this->pickupRequest->user_id,
            'phone' => auth()->user()->phone,
            'amount' => $this->pickupRequest->amount,
            'checkout_request_id' => 'stub-'.uniqid(),
            'mpesa_receipt' => 'STUB'.strtoupper(uniqid()),
            'status' => 'success',
        ]);

        $this->pickupRequest->update(['status' => 'paid']);

        session()->flash('success', 'Payment successful! Waiting for dispatch.');

        return $this->redirect(route('dashboard'));
    }

    public function render()
    {
        return view('livewire.payment-button');
    }
}
