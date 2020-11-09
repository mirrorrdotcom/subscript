<?php

namespace App\Http\Controllers\Api;

use App\Actions\SubscriptionModel\GetSubscriptionModelsAction;
use App\Http\Controllers\Controller;

class SubscriptionModelsController extends Controller
{
    public function all()
    {
        return (new GetSubscriptionModelsAction())->execute();
    }
}
