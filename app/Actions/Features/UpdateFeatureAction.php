<?php

namespace App\Actions\Features;

use App\Actions\AbstractUpdateAction;
use App\Contracts\AuditAction;
use Illuminate\Database\Eloquent\Model;

class UpdateFeatureAction extends AbstractUpdateAction implements AuditAction
{
    protected function update(Model $model, array $data)
    {
        $model->update($data);
    }
}
