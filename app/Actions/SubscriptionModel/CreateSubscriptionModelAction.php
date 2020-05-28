<?php

namespace App\Actions\SubscriptionModel;

use App\Actions\AbstractCreateAction;
use App\Contracts\AuditAction;
use App\Models\SubscriptionModel;

class CreateSubscriptionModelAction extends AbstractCreateAction implements AuditAction
{
    protected function create(array $data)
    {
        return SubscriptionModel::create($data);
    }
}
