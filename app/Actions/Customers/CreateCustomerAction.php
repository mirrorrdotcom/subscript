<?php

namespace App\Actions\Customers;

use App\Actions\AbstractCreateAction;
use App\Contracts\AuditAction;
use App\Models\Customer;

class CreateCustomerAction extends AbstractCreateAction implements AuditAction
{
    protected function create(array $data)
    {
        return Customer::create($data);
    }
}
