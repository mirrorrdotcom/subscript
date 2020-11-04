<?php

use Illuminate\Support\Facades\Route;

Route::name('api.')->prefix('v1')->group(function () {
    Route::middleware('auth:api')->name('customers.')->group(function () {
        Route::post('customers', 'Api\CustomersController@store')->name('store');
        Route::get('customers/{customer}', 'Api\CustomersController@get')->name('get');
    });
});