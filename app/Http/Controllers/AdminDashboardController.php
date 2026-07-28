<?php

namespace App\Http\Controllers;

use App\Models\PickupRequest;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $requests = PickupRequest::with('user', 'truck')
            ->whereNotIn('status', ['picked_up', 'cancelled'])
            ->latest()
            ->get();

        return view('admin.dashboard', compact('requests'));
    }
}