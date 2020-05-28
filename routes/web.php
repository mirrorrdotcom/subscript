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
    // Subscription Model
    Route::prefix("subscription-models")->name("subscription-models.")->group(function() {
        Route::get("", "SubscriptionModelsController@all")->name("all");
        Route::get("create", "SubscriptionModelsController@create")->name("create");
        Route::post("", "SubscriptionModelsController@store")->name("store");
        Route::get("{subscription_model}", "SubscriptionModelsController@edit")->name("edit");
        Route::put("{subscription_model}", "SubscriptionModelsController@update")->name("update");
        Route::delete("{subscription_model}", "SubscriptionModelsController@destroy")->name("destroy");
    });
});
