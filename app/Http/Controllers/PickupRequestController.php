<?php

namespace App\Http\Controllers;

use App\Models\PickupRequest;
use Illuminate\Http\Request;

class PickupRequestController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pickup_address' => 'required|string|max:255',
            'notes' => 'nullable|string|max:500',
        ]);

        // Block duplicate active requests
        $existing = $request->user()->pickupRequests()
            ->whereNotIn('status', ['picked_up', 'cancelled'])
            ->exists();

        if ($existing) {
            return back()->with('error', 'You already have an active request.');
        }

        $request->user()->pickupRequests()->create([
            'pickup_address' => $validated['pickup_address'],
            'notes' => $validated['notes'] ?? null,
            'pickup_lat' => $request->user()->latitude,
            'pickup_lng' => $request->user()->longitude,
            'amount' => 200, // flat rate for now, we'll wire this to STK push later
            'status' => 'pending_payment',
        ]);

        return redirect()->route('dashboard')->with('success', 'Request created, proceed to payment.');
    }

    public function cancel(PickupRequest $pickupRequest)
    {
        if ($pickupRequest->user_id !== auth()->id()) {
            abort(403);
        }

        if (in_array($pickupRequest->status, ['pending_payment', 'paid'])) {
            $pickupRequest->update(['status' => 'cancelled']);
        }

        return redirect()->route('dashboard')->with('success', 'Request cancelled.');
    }
}