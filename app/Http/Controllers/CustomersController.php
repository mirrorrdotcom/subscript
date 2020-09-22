<?php

namespace App\Http\Controllers;

use App\Actions\Customers\CreateCustomerAction;
use App\Actions\Customers\DeleteCustomerAction;
use App\Actions\Customers\GetCustomersAction;
use App\Actions\Customers\UpdateCustomerAction;
use App\Actions\Plans\GetPlansAction;
use App\Actions\Plans\UpdateCustomerPlanAction;
use App\Http\Requests\Customer\CreateCustomerRequest;
use App\Http\Requests\Customer\DeleteCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerPlanRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class CustomersController extends Controller
{
    public function all()
    {
        return view("customers.all")
            ->with("customers", (new GetCustomersAction())->execute());
    }

    public function create()
    {
        return view("customers.create");
    }

    public function store(CreateCustomerRequest $request)
    {
        if (!(new CreateCustomerAction())->execute($request->validated())) {
            return back()
                ->withErrors([ "error" => "Could not create customer. Please try again." ]);
        }

        return redirect()->route("customers.all");
    }

    public function edit(Customer $customer)
    {
        return view("customers.edit")
            ->with("customer", $customer)
            ->with("plan", $customer->plan)
            ->with("options", (new GetPlansAction())->execute());
    }

    public function update(Customer $customer, UpdateCustomerRequest $request)
    {
        if (! (new UpdateCustomerAction())->execute($customer, $request->validated())) {
            return back()
                ->withErrors([ "error" => "Could not update customer. Please try again." ]);
        }

        return redirect()->route("customers.all");
    }

    public function destroy(Customer $customer, DeleteCustomerRequest $request)
    {
        if (! (new DeleteCustomerAction())->execute($customer)) {
            return back()
                ->withErrors([ "error" => "Could not delete customer. Please try again" ]);
        }

        return redirect()->route("customers.all");
    }

    public function plans(Customer $customer)
    {
        return view("customers.plans.edit")
            ->with("customer", $customer)
            ->with("plan", $customer->plan)
            ->with("plans", (new GetPlansAction())->execute());
    }

    public function plansUpdate(Customer $customer, UpdateCustomerPlanRequest $request)
    {
        if (! (new UpdateCustomerPlanAction())->execute($customer, $request->validated())) {
            return back()
                ->withErrors([ "error" => "Could not update customer's plan. Please try again" ]);
        }

        return redirect()->route("customers.edit", [ "customer" => $customer ]);
    }

    public function get(Customer $customer)
    {
        if (! Auth::user()->hasPermissionTo('view customers')) {
            return response()->json([ "message" => "You can't access this API" ], 403);
        }

        return $customer->load('plan');
    }
}