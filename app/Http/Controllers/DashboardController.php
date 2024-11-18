<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Lab;

class DashboardController extends Controller
{
    public function index()
    {
        $labs = Lab::where('status', 'available')->get();
        $activeBookings = null;
        
        if (auth()->check()) {
            $activeBookings = Booking::where('user_id', auth()->id())
                ->where('status', 'active')
                ->with('lab')
                ->get();
        }
        
        return view('pages.dashboard', compact('labs', 'activeBookings'));
    }
}
