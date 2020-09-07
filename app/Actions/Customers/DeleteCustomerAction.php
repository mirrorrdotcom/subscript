<?php

namespace App\Actions\Customers;

use App\Actions\AbstractDeleteAction;
use App\Contracts\AuditAction;
use Illuminate\Database\Eloquent\Model;

class DeleteCustomerAction extends AbstractDeleteAction implements AuditAction
{
    protected function delete(Model $model, array $data = [])
    {
        $model->delete();
    }
}
