<?php

namespace App\Actions\Plans;

use App\Models\Plan;

class GetPlansAction
{
    public function execute(): array
    {
        return Plan::orderBy('sort_order')
            ->get(['name as label', 'id as value'])
            ->toArray();
    }
}
