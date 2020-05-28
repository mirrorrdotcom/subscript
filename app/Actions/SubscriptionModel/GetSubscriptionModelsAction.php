<?php

namespace App\Actions\SubscriptionModel;

use App\Models\SubscriptionModel;
use Illuminate\Database\Eloquent\Collection;

class GetSubscriptionModelsAction
{
    public function execute(): Collection
    {
        return SubscriptionModel::latest()->get();
    }
}
