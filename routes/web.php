<?php

use Illuminate\Support\Facades\Route;

// Auth Routes
Route::name("auth.")->group(function() {
    // Login Routes
    Route::middleware("guest")->name("login.")->group(function() {
        Route::get("login", "AuthController@login")->name("show");
        Route::post("login", "AuthController@attempt")->name("attempt");
    });
    // Logout Route
    Route::middleware("auth")->group(function() {
        Route::post("logout", "AuthController@logout")->name("logout");
    });
});

// Auth Routes
Route::middleware("auth")->group(function() {
    // Dashboard Route
    Route::get("", "DashboardController@show")->name("dashboard");
    // Audit Routes
    Route::prefix("audits")->name("audits.")->group(function() {
        Route::get("", "AuditsController@all")->name("all");
    });
    // Currencies Routes
    Route::prefix("currencies")->name("currencies.")->group(function() {
        Route::get("", "CurrenciesController@all")->name("all");
        Route::get("create", "CurrenciesController@create")->name("create");
        Route::post("", "CurrenciesController@store")->name("store");
        Route::get("{currency}", "CurrenciesController@edit")->name("edit");
        Route::put("{currency}", "CurrenciesController@update")->name("update");
        Route::delete("{currency}", "CurrenciesController@destroy")->name("destroy");
    });
    // Subscription Model Routes
    Route::prefix("subscription-models")->name("subscription-models.")->group(function() {
        Route::get("", "SubscriptionModelsController@all")->name("all");
        Route::get("create", "SubscriptionModelsController@create")->name("create");
        Route::post("", "SubscriptionModelsController@store")->name("store");
        Route::get("{subscription_model}", "SubscriptionModelsController@edit")->name("edit");
        Route::put("{subscription_model}", "SubscriptionModelsController@update")->name("update");
        Route::delete("{subscription_model}", "SubscriptionModelsController@destroy")->name("destroy");
        // Plans Routes
        Route::prefix("{subscription_model}/plans")->name("plans.")->group(function() {
            Route::get("", "PlansController@all")->name("all");
            Route::get("create", "PlansController@create")->name("create");
            Route::post("", "PlansController@store")->name("store");
            Route::get("{plan}", "PlansController@edit")->name("edit");
            Route::put("{plan}", "PlansController@update")->name("update");
            Route::delete("{plan}", "PlansController@destroy")->name("destroy");
        });
        // Features Routes
        Route::prefix("{subscription_model}/features")->name("features.")->group(function() {
            Route::get("", "FeaturesController@all")->name("all");
            Route::get("create", "FeaturesController@create")->name("create");
            Route::post("", "FeaturesController@store")->name("store");
            Route::get("{feature}", "FeaturesController@edit")->name("edit");
            Route::put("{feature}", "FeaturesController@update")->name("update");
            Route::delete("{feature}", "FeaturesController@destroy")->name("destroy");
        });
    });
    // Customers Routes
    Route::prefix("customers")->name("customers.")->group(function() {
        Route::get("", "CustomersController@all")->name("all");
        Route::get("create", "CustomersController@create")->name("create");
        Route::post("", "CustomersController@store")->name("store");
        Route::get("{customer}", "CustomersController@edit")->name("edit");
        Route::put("{customer}", "CustomersController@update")->name("update");
        Route::delete("{customer}", "CustomersController@destroy")->name("destroy");

        Route::prefix("{customer}/plans")->name("plans.")->group(function() {
            Route::get("", "CustomersController@plans")->name("edit");
            Route::put("", "CustomersController@plansUpdate")->name("update");
        });
    });
});
