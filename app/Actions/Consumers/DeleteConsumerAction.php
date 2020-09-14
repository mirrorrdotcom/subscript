<?php

namespace App\Actions\Consumers;

use App\Actions\AbstractDeleteAction;
use App\Contracts\AuditAction;
use Illuminate\Database\Eloquent\Model;

class DeleteConsumerAction extends AbstractDeleteAction implements AuditAction
{
    protected function delete(Model $model, array $data = [])
    {
        $model->delete();
    }
}
