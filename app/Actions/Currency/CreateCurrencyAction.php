<?php

namespace App\Actions\Currency;

use App\Actions\AbstractCreateAction;
use App\Contracts\AuditAction;
use App\Models\Currency;

class CreateCurrencyAction extends AbstractCreateAction implements AuditAction
{
    protected function create(array $data)
    {
        return Currency::create($data);
    }
}
