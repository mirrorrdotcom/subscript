<?php

use Illuminate\Support\Facades\Route;

// Auth Routes
Route::name("auth.")->group(function() {
    Route::middleware("guest")->name("login.")->group(function() {
        Route::get("login", "AuthController@login")->name("show");
        Route::post("login", "AuthController@attempt")->name("attempt");
    });
    Route::middleware("auth")->group(function() {
        Route::post("logout", "AuthController@logout")->name("logout");
    });
});

// Dashboard Routes
Route::middleware("auth")->group(function() {
    Route::get("", "DashboardController@show")->name("dashboard");
});
