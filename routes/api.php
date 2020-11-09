<?php

use Illuminate\Support\Facades\Route;

Route::name('api.')->prefix('v1')->group(function () {
    Route::middleware('auth:api')->group(function () {
        Route::prefix('customers')->name('customers.')->group(function () {
            Route::post('', 'Api\CustomersController@store')->name('store');
            Route::get('{customer}', 'Api\CustomersController@get')->name('get');

            Route::prefix("{customer}/plan")->name("plans.")->group(function() {
                Route::get('', 'Api\CustomersController@plan')->name('get');
                Route::put('', 'Api\CustomersController@planUpdate')->name('update');
            });
        });

        Route::prefix('plans')->name('plans.')->group(function () {
            Route::get('{plan}', 'Api\PlansController@get')->name('get');
        });

        Route::prefix('subscription-models')->name('subscription-models.')->group(function () {
            Route::get('', 'Api\SubscriptionModelsController@all')->name('all');
        });
    });
});