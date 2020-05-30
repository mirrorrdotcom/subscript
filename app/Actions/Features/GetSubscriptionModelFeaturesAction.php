<?php

namespace App\Actions\Features;

use App\Models\SubscriptionModel;
use Illuminate\Database\Eloquent\Collection;

class GetSubscriptionModelFeaturesAction
{
    public function execute(SubscriptionModel $subscription_model): Collection
    {
        return $subscription_model->features()
            ->latest()
            ->get();
    }
}
