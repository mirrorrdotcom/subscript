<?php

// Dashboard
Breadcrumbs::for('dashboard', function($trail) {
    $trail->push("Dashboard", route("dashboard"));
});

// Audits
Breadcrumbs::for('audits.all', function($trail) {
    $trail->push('Audits', route('audits.all'));
});

// Currencies
Breadcrumbs::for("currencies.all", function($trail) {
    $trail->push("Currencies", route("currencies.all"));
});
Breadcrumbs::for("currencies.create", function($trail) {
    $trail->parent("currencies.all");
    $trail->push("New", route("currencies.create"));
});
Breadcrumbs::for("currencies.edit", function($trail, $currency) {
    $trail->parent("currencies.all");
    $trail->push(strtoupper($currency->code), route("currencies.edit", [ "currency" => $currency ]));
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

//Customers
Breadcrumbs::for("customers.all", function ($trail) {
    $trail->push("Customers", route("customers.all"));
});
Breadcrumbs::for("customers.create", function ($trail) {
    $trail->parent("customers.all");
    $trail->push("New", route("customers.create"));
});
Breadcrumbs::for("customers.edit", function ($trail, $customer) {
    $trail->parent("customers.all");
    $trail->push($customer->name, route("customers.edit", ["customer" => $customer]));
});
Breadcrumbs::for("customers.plans.edit", function ($trail, $customer) {
    $trail->parent("customers.edit", $customer);
    $trail->push("Edit Plan", route("customers.plans.edit", ["customer" => $customer]));
});

//Consumers
Breadcrumbs::for("consumers.all", function ($trail) {
    $trail->push("Consumers", route("consumers.all"));
});
Breadcrumbs::for("consumers.create", function ($trail) {
    $trail->parent("consumers.all");
    $trail->push("New", route("consumers.create"));
});
Breadcrumbs::for("consumers.edit", function ($trail, $consumer) {
    $trail->parent("consumers.all");
    $trail->push($consumer->name, route("consumers.edit", ["consumer" => $consumer]));
});