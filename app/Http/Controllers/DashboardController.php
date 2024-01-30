<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Check if the user is authorized to access the dashboard
        if (Gate::denies('access-dashboard', $request->user())) {
            abort(403, 'Unauthorized action.');
        }

        // Add your dashboard logic here

        return view('dashboard');
    }
}
