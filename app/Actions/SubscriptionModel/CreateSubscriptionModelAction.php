<?php

namespace App\Actions\SubscriptionModel;

use App\Actions\AbstractCreateAction;
use App\Models\SubscriptionModel;

class CreateSubscriptionModelAction extends AbstractCreateAction
{
    protected function create(array $data)
    {
        return SubscriptionModel::create($data);
    }
}
