<?php

namespace App\Http\Controllers\Api;

use App\Actions\Customers\FindOrCreateCustomerAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\FindOrCreateCustomerRequest;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class CustomersController extends Controller
{
    public function store(FindOrCreateCustomerRequest $request)
    {
        if (! Auth::user()->hasPermissionTo('create customers')) {
            return response()->json([ "message" => "You can't access this API" ], 403);
        }

        $customer = (new FindOrCreateCustomerAction())->execute($request->validated(), true);

        if ($customer instanceof Customer) {
            return $customer;
        }

        return response()->json([ "message" => "Couldn't add the customer"], 404);
    }

    public function get(Customer $customer)
    {
        if (! Auth::user()->hasPermissionTo('view customers')) {
            return response()->json([ "message" => "You can't access this API" ], 403);
        }

        return $customer->makeHidden('plans');
    }

    public function plans(Customer $customer)
    {
        if (! Auth::user()->hasPermissionTo('view customers')) {
            return response()->json([ "message" => "You can't access this API" ], 403);
        }

        return $customer->load('plans');
    }
}