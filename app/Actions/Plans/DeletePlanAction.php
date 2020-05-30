<?php

namespace App\Actions\Plans;

use App\Actions\AbstractDeleteAction;
use App\Contracts\AuditAction;
use Illuminate\Database\Eloquent\Model;

class DeletePlanAction extends AbstractDeleteAction implements AuditAction
{
    protected function delete(Model $model, array $data = [])
    {
        $model->delete();
    }
}
