<?php

namespace App\Actions\Currency;

use App\Actions\AbstractUpdateAction;
use App\Contracts\AuditAction;
use Illuminate\Database\Eloquent\Model;

class UpdateCurrencyAction extends AbstractUpdateAction implements AuditAction
{
    protected function update(Model $model, array $data)
    {
        $model->update($data);
    }
}
