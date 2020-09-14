<?php

namespace App\Actions\Consumers;

use App\Actions\AbstractUpdateAction;
use App\Contracts\AuditAction;
use Illuminate\Database\Eloquent\Model;

class UpdateConsumerAction extends AbstractUpdateAction implements AuditAction
{
    protected function update(Model $model, array $data)
    {
        $model->update($data);
    }
}
