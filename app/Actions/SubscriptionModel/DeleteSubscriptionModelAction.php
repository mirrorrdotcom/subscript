<?php

namespace App\Actions\SubscriptionModel;

use App\Actions\AbstractDeleteAction;
use Illuminate\Database\Eloquent\Model;

class DeleteSubscriptionModelAction extends AbstractDeleteAction
{
    protected function delete(Model $model, array $data = [])
    {
        $model->delete();
    }
}
