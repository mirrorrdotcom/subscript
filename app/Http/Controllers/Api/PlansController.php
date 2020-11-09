<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plan;

class PlansController extends Controller
{
    public function get(Plan $plan)
    {
        return $plan->load(['features', 'subscription_model']);
    }
}
