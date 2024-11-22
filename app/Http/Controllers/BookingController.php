<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use App\Models\Booking;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $labs = Lab::where('status', 'available')->get();
        return view('bookings.index', compact('labs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lab_id' => 'required|exists:labs,id',
            'start_time' => 'required|date|after:now',
        ]);

        $lab = Lab::findOrFail($request->lab_id);
        
        if ($lab->status === 'booked') {
            return back()->with('error', 'Lab sudah dibooking');
        }

        // Create booking
        $booking = Booking::create([
            'user_id' => auth()->id(),
            'lab_id' => $request->lab_id,
            'start_time' => $request->start_time,
            'status' => 'active',
        ]);

        // Update lab status
        $lab->update(['status' => 'booked']);

        return redirect()->route('my-bookings')->with('success', 'Booking berhasil');
    }

    public function myBookings()
    {
        $bookings = Booking::where('user_id', auth()->id())
            ->with('lab')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('bookings.my-bookings', compact('bookings'));
    }

    public function checkout(Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            return back()->with('error', 'Unauthorized action');
        }

        $booking->update([
            'status' => 'completed',
            'end_time' => now(),
        ]);

        $booking->lab->update(['status' => 'available']);

        return back()->with('success', 'Lab has been checked out successfully');
    }
    public function exportPdf()
{
    // Ambil semua data booking
    $bookings = Booking::with(['user', 'lab'])->get();

    // Buat PDF dengan data booking
    $pdf = Pdf::loadView('pdf.bookings', compact('bookings'));

    // Unduh file PDF
    return $pdf->download('booking-history.pdf');
}
}