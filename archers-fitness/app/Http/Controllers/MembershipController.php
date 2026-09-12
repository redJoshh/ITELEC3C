<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembershipController extends Controller
{

    public function index()
    {
        $membership = Auth::user()->membership;
        if (!$membership) {
            return redirect()->route('dashboard')->with('error', "Please apply first for a membership");
        }

        $pricing = [
            'student' => [
                'monthly' => 1600,
                'yearly' => 13000,
            ],
            'standard' => [
                'monthly' => 2500,
                'yearly' => 20000,
            ],
        ];
        $cost = $pricing[$membership->plan][$membership->billing];

        return view('membership.index', compact('membership', 'cost'));
    }
    public function apply(Request $request)
    {
        $validated = $request->validate([
            'plan' => 'required|in:standard,student',
            'student_id' => 'exclude_unless:plan,student|required|string|max:255',
            'billing' => 'required|in:monthly,yearly',
        ]);

        Membership::create([
            'user_id' => Auth::id(),
            'plan' => $validated['plan'],
            'student_id' => $validated['student_id'] ?? null,
            'billing' => $validated['billing'],
            'status' => 'active',
        ]);

        return redirect()->route('dashboard')->with('success', 'Your ' . $validated['plan'] . ' membership application has been submitted successfully! Please visit the front desk to finalize.');
    }

    public function cancelMembership()
    {
        $membership = Auth::user()->membership();
        if ($membership) {
            $membership->update(['status' => 'inactive']);
        }
        return redirect()->route('dashboard')->with('success', "Your membership has been successfully canceled. We're sad to see you go :((");

    }
}
