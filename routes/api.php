<?php

use Illuminate\Support\Facades\Route;

Route::name('api.')->prefix('v1')->group(function () {
    Route::middleware('auth:api')->group(function () {
        Route::get('customers/{customer}', 'CustomersController@get');
    });
});