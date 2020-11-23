<?php

namespace App\Actions\Subscriptions;

use App\Models\Customer;
use App\Models\Plan;

class RenewCustomerSubscriptionAction
{
    public function execute(Customer $customer, Plan $plan)
    {
        $sources = $customer->sources;
        if ($sources->isEmpty()) {
            return response()->json(['message' => "The customer doesn't have any payment methods stored"]);
        }

        if ($customer->hasUpcomingPlan()) {
            return response()->json(['message' => 'The customer already has an upcoming plan they subscribed to']);
        }

        if (! $customer->payForPlanAndActivateIt($plan)) {
            return response()->json(['message' => 'An error occurred trying to subscribe to the plan']);
        }

        return $customer->refresh()->makeHidden(['plans', 'sources']);
    }
}