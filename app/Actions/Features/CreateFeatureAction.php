<?php

namespace App\Actions\Features;

use App\Actions\AbstractCreateAction;
use App\Contracts\AuditAction;
use App\Models\Feature;

class CreateFeatureAction extends AbstractCreateAction implements AuditAction
{
    protected function create(array $data)
    {
        return Feature::create($data);
    }
}
