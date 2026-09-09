<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class GuestPageController extends Controller
{
    //
    public function index()
    {
        return view('guest.index');
    }

    public function about()
    {
        return view('guest.about');
    }

    public function services()
    {
        return view('guest.services');
    }
    public function contact()
    {
        return view('guest.contact');
    }
    public function submitMessageContact(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'fbLink' => 'nullable|url',
            'message' => 'required|string|max:1000',
        ]);
        ContactMessage::create($validatedData);

        return redirect()->route('contact')->with('success', 'Thanks for reaching out!');
    }

    public function homeWorkouts(string $target = 'default')
    {
        $muscleTarget = [
            'default' => ["Please choose a target area to get a workout routine."],
            'upper-body' => ["2 sets of push-ups (until Failure)", " 2 sets of pull-ups (until Failure)", "Great for building upper body strength, targeting chest, shoulders, and back muscles."],
            'lower-body' => ["3 sets of squats (15 reps)", ' 3 sets of lunges (12 reps per leg)', "Excellent for strengthening legs and glutes."],
            'core' => ["3 sets of bicycle crunches until failure", "3 sets of leg raises until failure", "3 sets 60-second planks", "Focuses on building core strength and stability."],
        ];

        $routine = $muscleTarget[$target] ?? "Workout routine not found. Please select a valid target area.";
        return view('guest.home-workouts', ['focusArea' => ucfirst(str_replace('-', ' ', $target)), 'routine' => $routine]);
    }
}
