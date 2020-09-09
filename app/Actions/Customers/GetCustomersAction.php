<?php

namespace App\Actions\Customers;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;

class GetCustomersAction
{
    public function execute() : Collection
    {
        return Customer::with('plan')->get();
    }
}