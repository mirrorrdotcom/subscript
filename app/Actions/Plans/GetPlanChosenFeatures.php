<?php

namespace App\Actions\Plans;

use App\Models\Plan;

class GetPlanChosenFeatures
{
    public function execute(Plan $plan): array
    {
        return $plan->features()
            ->orderBy("name", "asc")
            ->get()
            ->pluck("id")
            ->toArray();
    }
}
