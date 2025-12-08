<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContributorDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Contributeur');
    }

    public function index()
    {
        $user = Auth::user();

        $contenus = $user->contenus()
            ->with(['region', 'langue'])
            ->latest()
            ->paginate(10);

        return view('contributor.dashboard', compact('user', 'contenus'));
    }
}