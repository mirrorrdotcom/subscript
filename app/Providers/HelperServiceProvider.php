<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->registerHelpers();
    }

    protected function registerHelpers()
    {
        foreach (glob(__DIR__ . "/../Helpers/*.php") as $filename) {
            require_once $filename;
        }
    }
}
