<?php

namespace App\Actions\Customers;

use App\Actions\AbstractCreateAction;
use App\Contracts\AuditAction;
use App\Models\Customer;

class FindOrCreateCustomerAction extends AbstractCreateAction implements AuditAction
{
    protected function create(array $data)
    {
        return $this->findOrNew($data);
    }

    private function findOrNew(array $data)
    {
        $customer = $this->getCustomerByEmail($data['email']);

        return empty($customer) ? $this->createNewCustomer($data) : $customer;
    }

    private function getCustomerByEmail($email)
    {
        return Customer::with('plan')
            ->where('email', $email)
            ->first();
    }

    private function createNewCustomer(array $data)
    {
        return Customer::create($data);
    }
}
