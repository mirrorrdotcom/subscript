<?php

namespace App\Actions\SubscriptionModel;

use App\Actions\AbstractDeleteAction;
use App\Contracts\AuditAction;
use Illuminate\Database\Eloquent\Model;

class DeleteSubscriptionModelAction extends AbstractDeleteAction implements AuditAction
{
    protected function delete(Model $model, array $data = [])
    {
        $model->delete();
    }
}
