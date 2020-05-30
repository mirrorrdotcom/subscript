<?php

namespace App\Actions\Plans;

use App\Actions\AbstractCreateAction;
use App\Contracts\AuditAction;
use App\Models\Plan;

class CreatePlanAction extends AbstractCreateAction implements AuditAction
{
    protected function create(array $data)
    {
        $plan = Plan::create($data);

        $plan->features()->sync($data["features"]);

        return $plan;
    }
}
