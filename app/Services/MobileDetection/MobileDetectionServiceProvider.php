<?php

namespace App\Services\MobileDetection;

use Illuminate\Support\ServiceProvider;

class MobileDetectionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Mobile_Detect','App\Services\MobileDetection\Mobile_Detect');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
