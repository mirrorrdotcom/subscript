<?php

namespace App\Actions\Plans;

use App\Actions\AbstractUpdateAction;
use App\Contracts\AuditAction;
use Illuminate\Database\Eloquent\Model;

class UpdateCustomerPlanAction extends AbstractUpdateAction implements AuditAction
{
    protected function update(Model $model, array $data)
    {
        if ($data['plan_id'] != $model->plan_id) {
            $model->update($data);
        }
    }
}
