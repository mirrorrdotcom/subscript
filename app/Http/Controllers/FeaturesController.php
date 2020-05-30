<?php

namespace App\Http\Controllers;

use App\Actions\Features\CreateFeatureAction;
use App\Actions\Features\DeleteFeatureAction;
use App\Actions\Features\GetSubscriptionModelFeaturesAction;
use App\Actions\Features\UpdateFeatureAction;
use App\Http\Requests\Feature\CreateFeatureRequest;
use App\Http\Requests\Feature\DeleteFeatureRequest;
use App\Http\Requests\Feature\UpdateFeatureRequest;
use App\Models\Feature;
use App\Models\SubscriptionModel;
use Illuminate\Http\Request;

class FeaturesController extends Controller
{
    public function all(SubscriptionModel $subscription_model)
    {
        $features = (new GetSubscriptionModelFeaturesAction())
            ->execute($subscription_model);

        return view("subscription-models.features.all")
            ->with("subscription_model", $subscription_model)
            ->with("features", $features);
    }

    public function create(SubscriptionModel $subscription_model)
    {
        return view("subscription-models.features.create")
            ->with("subscription_model", $subscription_model);
    }

    public function store(SubscriptionModel $subscription_model, CreateFeatureRequest $request)
    {
        if (!(new CreateFeatureAction())->execute($request->validated())) {
            return back()
                ->withErrors([ "error" => "Could not create feature. Please try again." ]);
        }

        return redirect()->route(
            "subscription-models.features.all",
            [ "subscription_model" => $subscription_model ]
        );
    }

    public function edit(
        SubscriptionModel $subscription_model,
        Feature $feature
    ) {
        return view("subscription-models.features.edit")
            ->with("subscription_model", $subscription_model)
            ->with("feature", $feature);
    }

    public function update(
        SubscriptionModel $subscription_model,
        Feature $feature,
        UpdateFeatureRequest $request
    ) {
        if (!(new UpdateFeatureAction())->execute($feature, $request->validated())) {
            return back()
                ->withErrors([ "error" => "Could not update feature. Please try again." ]);
        }

        return redirect()->route(
            "subscription-models.features.all",
            [ "subscription_model" => $subscription_model ]
        );
    }

    public function destroy(
        SubscriptionModel $subscription_model,
        Feature $feature,
        DeleteFeatureRequest $request
    ) {
        if (!(new DeleteFeatureAction())->execute($feature)) {
            return back()
                ->withErrors([ "error" => "Could not delete feature. Please try again." ]);
        }

        return redirect()->route(
            "subscription-models.features.all",
            [ "subscription_model" => $subscription_model ]
        );
    }
}
