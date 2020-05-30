<?php

// Dashboard
Breadcrumbs::for('dashboard', function($trail) {
    $trail->push("Dashboard", route("dashboard"));
});

// Subscription Models
Breadcrumbs::for('subscription-models.all', function($trail) {
    $trail->push('Subscription Models', route('subscription-models.all'));
});
Breadcrumbs::for("subscription-models.create", function($trail) {
    $trail->parent("subscription-models.all");
    $trail->push("New", route("subscription-models.create"));
});
Breadcrumbs::for("subscription-models.edit", function($trail, $subscription_model) {
    $trail->parent("subscription-models.all");
    $trail->push($subscription_model->name, route("subscription-models.edit", [ "subscription_model" => $subscription_model ]));
});

// Subscription Model Features
Breadcrumbs::for("subscription-models.features.all", function($trail, $subscription_model) {
    $trail->parent("subscription-models.edit", $subscription_model);
    $trail->push("Features", route("subscription-models.features.all", [ "subscription_model" => $subscription_model ]));
});
Breadcrumbs::for("subscription-models.features.create", function($trail, $subscription_model) {
    $trail->parent("subscription-models.features.all", $subscription_model);
    $trail->push("New", route("subscription-models.features.create", [ "subscription_model" => $subscription_model ]));
});
Breadcrumbs::for("subscription-models.features.edit", function($trail, $subscription_model, $feature) {
    $trail->parent("subscription-models.features.all", $subscription_model);
    $trail->push($feature->name, route("subscription-models.features.edit", [ "subscription_model" => $subscription_model, "feature" => $feature ]));
});

// Subscription Model Plans
Breadcrumbs::for("subscription-models.plans.all", function($trail, $subscription_model) {
    $trail->parent("subscription-models.edit", $subscription_model);
    $trail->push("Plans", route("subscription-models.plans.all", [ "subscription_model" => $subscription_model ]));
});
Breadcrumbs::for("subscription-models.plans.create", function($trail, $subscription_model) {
    $trail->parent("subscription-models.plans.all", $subscription_model);
    $trail->push("New", route("subscription-models.plans.create", [ "subscription_model" => $subscription_model ]));
});
Breadcrumbs::for("subscription-models.plans.edit", function($trail, $subscription_model, $plan) {
    $trail->parent("subscription-models.plans.all", $subscription_model);
    $trail->push($plan->name, route("subscription-models.plans.edit", [ "subscription_model" => $subscription_model, "plan" => $plan ]));
});
