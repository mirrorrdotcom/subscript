<?php

namespace App\Http\Controllers;

use App\Actions\Plans\CreatePlanAction;
use App\Actions\Plans\DeletePlanAction;
use App\Actions\Plans\GetPlanChosenFeatures;
use App\Actions\Plans\GetSubscriptionModelPlansAction;
use App\Actions\Plans\UpdatePlanAction;
use App\Actions\SubscriptionModel\GetFeaturesForSubscriptionModel;
use App\Http\Requests\Plan\CreatePlanRequest;
use App\Http\Requests\Plan\DeletePlanRequest;
use App\Http\Requests\Plan\UpdatePlanRequest;
use App\Models\Plan;
use App\Models\SubscriptionModel;
use App\Services\TimeInterval;

class PlansController extends Controller
{
    public function all(SubscriptionModel $subscription_model)
    {
        $plans = (new GetSubscriptionModelPlansAction)
            ->execute($subscription_model);

        return view("subscription-models.plans.all")
            ->with("subscription_model", $subscription_model)
            ->with("plans", $plans);
    }

    public function create(SubscriptionModel $subscription_model)
    {
        return view("subscription-models.plans.create")
            ->with("intervals", TimeInterval::dropdownOptions())
            ->with("features", (new GetFeaturesForSubscriptionModel())->execute($subscription_model))
            ->with("subscription_model", $subscription_model);
    }

    public function store(
        SubscriptionModel $subscription_model,
        CreatePlanRequest $request
    ) {
        if (!(new CreatePlanAction())->execute($request->validated())) {
            return back()
                ->withErrors([ "error" => "Could not create plan. Please try again." ]);
        }

        return redirect()->route(
            "subscription-models.plans.all",
            [ "subscription_model" => $subscription_model]
        );
    }

    public function edit(SubscriptionModel $subscription_model, Plan $plan)
    {
        return view("subscription-models.plans.edit")
            ->with("intervals", TimeInterval::dropdownOptions())
            ->with("subscription_model", $subscription_model)
            ->with("features", (new GetFeaturesForSubscriptionModel())->execute($subscription_model))
            ->with("chosen_features", (new GetPlanChosenFeatures())->execute($plan))
            ->with("plan", $plan);
    }

    public function update(
        SubscriptionModel $subscription_model,
        Plan $plan,
        UpdatePlanRequest $request
    ) {
        if (!(new UpdatePlanAction())->execute($plan, $request->validated())) {
            return back()
                ->withErrors([ "error" => "Could not update plan. Please try again." ]);
        }

        return redirect()->route(
            "subscription-models.plans.all",
            [ "subscription_model" => $subscription_model]
        );
    }

    public function destroy(
        SubscriptionModel $subscription_model,
        Plan $plan,
        DeletePlanRequest $request
    ) {
        if (!(new DeletePlanAction())->execute($plan)) {
            return back()
                ->withErrors([ "error" => "Could not delete plan. Please try again." ]);
        }

        return redirect()->route(
            "subscription-models.plans.all",
            [ "subscription_model" => $subscription_model]
        );
    }
}
