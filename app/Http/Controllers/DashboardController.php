<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $activeRequest = auth()->user()->pickupRequests()
            ->whereNotIn('status', ['picked_up', 'cancelled'])
            ->latest()
            ->first();

        return view('dashboard', compact('activeRequest'));
    }
}