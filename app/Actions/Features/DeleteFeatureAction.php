<?php

namespace App\Actions\Features;

use App\Actions\AbstractDeleteAction;
use App\Contracts\AuditAction;
use Illuminate\Database\Eloquent\Model;

class DeleteFeatureAction extends AbstractDeleteAction implements AuditAction
{
    protected function delete(Model $model, array $data = [])
    {
        $model->delete();
    }
}
