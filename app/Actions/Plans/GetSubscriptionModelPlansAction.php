<?php

namespace App\Actions\Plans;

use App\Models\SubscriptionModel;
use Illuminate\Database\Eloquent\Collection;

class GetSubscriptionModelPlansAction
{
    public function execute(SubscriptionModel $subscription_model): Collection
    {
        return $subscription_model->plans()
            ->latest()
            ->get();
    }
}
