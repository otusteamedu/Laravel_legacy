<?php

namespace App\Services\CityByIpResolver;

use Illuminate\Support\ServiceProvider;

class CityByIpResolverServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Services\CityByIpResolver','App\Services\CityByIpResolver\CityByIpResolver');
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
