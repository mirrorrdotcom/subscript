<?php

namespace App\Actions\Consumers;

use App\Actions\AbstractUpdateAction;
use App\Contracts\AuditAction;
use Illuminate\Database\Eloquent\Model;

class UpdateConsumerTokenAction extends AbstractUpdateAction implements AuditAction
{
    protected function update(Model $model, array $data)
    {
        $model->generateAndSetNewApiToken()->save();
    }
}
