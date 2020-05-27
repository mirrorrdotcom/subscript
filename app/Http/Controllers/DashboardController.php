<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function show()
    {
        return view("dashboard.show")
            ->with("user", Auth::user());
    }
}
