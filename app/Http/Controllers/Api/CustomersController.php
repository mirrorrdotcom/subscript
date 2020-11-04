<?php

namespace App\Http\Controllers\Api;

use App\Actions\Customers\FindOrCreateCustomerAction;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CustomersController extends Controller
{
    public function store(Request $request)
    {
        if (! Auth::user()->hasPermissionTo('create customers')) {
            return response()->json([ "message" => "You can't access this API" ], 403);
        }

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 403);
        }

        $customer = (new FindOrCreateCustomerAction())->execute($request->all(), true);

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

        return $customer->load('plan');
    }
}