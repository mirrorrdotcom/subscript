<?php

namespace App\Http\Controllers;

use App\Actions\SubscriptionModel\CreateSubscriptionModelAction;
use App\Actions\SubscriptionModel\DeleteSubscriptionModelAction;
use App\Actions\SubscriptionModel\GetSubscriptionModelsAction;
use App\Actions\SubscriptionModel\UpdateSubscriptionModelAction;
use App\Http\Requests\SubscriptionModel\CreateSubscriptionModelRequest;
use App\Http\Requests\SubscriptionModel\DeleteSubscriptionModelRequest;
use App\Http\Requests\SubscriptionModel\UpdateSubscriptionModelRequest;
use App\Models\SubscriptionModel;

class SubscriptionModelsController extends Controller
{
    public function all()
    {
        return view("subscription-models.all")
            ->with("resource", (new GetSubscriptionModelsAction())->execute());
    }

    public function create()
    {
        return view("subscription-models.create");
    }

    public function store(CreateSubscriptionModelRequest $request)
    {
        if (!(new CreateSubscriptionModelAction())->execute($request->validated())) {
            return back()
                ->withErrors([ "error" => "Could not create subscription model. Please try again." ]);
        }

        return redirect()->route("subscription-models.all");
    }

    public function edit(SubscriptionModel $subscription_model)
    {
        return view("subscription-models.edit")
            ->with("resource", $subscription_model);
    }

    public function update(SubscriptionModel $subscription_model, UpdateSubscriptionModelRequest $request) {
        if (!(new UpdateSubscriptionModelAction())->execute($subscription_model, $request->validated())) {
            return back()
                ->withErrors([ "error" => "Could not update subscription model. Please try again." ]);
        }

        return redirect()->route("subscription-models.all");
    }

    public function destroy(SubscriptionModel $subscription_model, DeleteSubscriptionModelRequest $request) {
        if (!(new DeleteSubscriptionModelAction())->execute($subscription_model)) {
            return back()
                ->withErrors([ "error" => "Could not delete subscription model. Please try again." ]);
        }

        return redirect()->route("subscription-models.all");
    }
}
