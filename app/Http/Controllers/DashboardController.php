<?php

namespace App\Http\Controllers;

use App\Models\Rating;

class DashboardController extends Controller
{
    public function index()
    {
        $histories = Rating::where('user_id', auth()->id())
            ->orderByDesc('date')
            ->take(3)
            ->get();

        return view('dashboard', compact('histories'));
    }
}
