<?php

namespace App\Actions\SubscriptionModel;

use App\Actions\AbstractUpdateAction;
use App\Contracts\AuditAction;
use Illuminate\Database\Eloquent\Model;

class UpdateSubscriptionModelAction extends AbstractUpdateAction implements AuditAction
{
    protected function update(Model $model, array $data)
    {
        $model->update($data);
    }
}
