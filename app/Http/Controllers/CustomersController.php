<?php

namespace App\Http\Controllers;

use App\Actions\Customers\CreateCustomerAction;
use App\Actions\Customers\DeleteCustomerAction;
use App\Actions\Customers\GetCustomersAction;
use App\Actions\Customers\UpdateCustomerAction;
use App\Http\Requests\Customer\CreateCustomerRequest;
use App\Http\Requests\Customer\DeleteCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Models\Customer;
use App\Models\Plan;

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
            ->with("options", $this->getPlans());
    }

    private function getPlans() : array
    {
        return Plan::orderBy('sort_order')
            ->get(['name as label', 'id as value'])
            ->toArray();
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
}