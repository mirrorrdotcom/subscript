<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Plan;

class PlansController extends Controller
{
    public function get(Plan $plan)
    {
        return $plan->load(['features', 'subscription_model']);
    }

    public function subscribe(Customer $customer, Plan $plan)
    {
        $sources = $customer->sources;
        if ($sources->isEmpty()) {
            return response()->json(['message' => "The customer doesn't have any payment methods stored"]);
        }

        if ($customer->isSubscribedToPlan($plan)) {
            return response()->json(['message' => 'The customer is already subscribed to this plan']);
        }

        if ($customer->hasUpcomingPlan()) {
            return response()->json(['message' => 'The customer already has an upcoming plan they subscribed to']);
        }

        if (! $customer->payForPlanAndActivateIt($plan)) {
            return response()->json(['message' => 'An error occurred trying to subscribe to the plan']);
        }

        return $customer->plan;
    }
}
