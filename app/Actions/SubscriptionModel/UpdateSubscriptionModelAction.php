<?php

namespace App\Actions\SubscriptionModel;

use App\Actions\AbstractUpdateAction;
use Illuminate\Database\Eloquent\Model;

class UpdateSubscriptionModelAction extends AbstractUpdateAction
{
    protected function update(Model $model, array $data)
    {
        $model->update($data);
    }
}
