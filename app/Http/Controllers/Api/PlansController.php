<?php

namespace App\Http\Controllers\Api;

use App\Actions\Subscriptions\SubscribeCustomerToPlanAction;
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
        return (new SubscribeCustomerToPlanAction())->execute($customer, $plan);
    }
}
