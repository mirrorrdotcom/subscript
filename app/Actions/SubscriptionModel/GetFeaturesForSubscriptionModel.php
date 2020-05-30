<?php

namespace App\Actions\SubscriptionModel;

use App\Models\SubscriptionModel;

class GetFeaturesForSubscriptionModel
{
    public function execute(SubscriptionModel $subscription_model): array
    {
        return $subscription_model->features()
            ->select("id", "name")
            ->orderBy("name", "asc")
            ->get()
            ->pluck("name", "id")
            ->toArray();
    }
}
