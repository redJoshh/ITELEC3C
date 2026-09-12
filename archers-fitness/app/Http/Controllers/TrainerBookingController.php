<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainerBooking;
use App\Models\Membership;
use Illuminate\Support\Facades\Auth;

class TrainerBookingController extends Controller
{
    //

    public function index()
    {
        $membership = Auth::user()->membership;
        if (!$membership || $membership->status == "inactive" || $membership->status == 'pending') {
            return redirect()->route('dashboard')->with('error', 'Please approach front desk about your membership first.');
        }
        $bookings = Auth::user()->trainerBookings()->latest()->get();

        $trainers = [
            'Coach Jarvey' => "Upper-Lower Split Strategy",
            'Coach Remiel' => "Push-Pull-Legs Split Strategy",
            'Coach Glenn' => "Loss Weight Journey (Cardio and Diet)"
        ];

        return view('trainer.book', compact('bookings', 'trainers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'trainer_name' => 'required|string|max:255',
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required',
        ]);
        TrainerBooking::create([
            'user_id' => Auth::id(),
            'trainer_name' => $validated['trainer_name'],
            'booking_date' => $validated['booking_date'],
            'booking_time' => $validated['booking_time'],
            'status' => 'confirmed',
        ]);

        return redirect()->route('trainer.book')->with('success', 'Training with ' . $validated['trainer_name'] . ' session booked successfully!');
    }

}
