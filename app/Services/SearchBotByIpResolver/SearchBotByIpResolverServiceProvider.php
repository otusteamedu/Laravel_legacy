<?php

namespace App\Services\CityByIpResolver;

use Illuminate\Support\ServiceProvider;

/**
 * Class SearchBotByIpResolverServiceProvider
 * @package App\Services\CityByIpResolver
 */
class SearchBotByIpResolverServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Services\SearchBotByIpResolver','App\Services\SearchBotByIpResolver\SearchBotByIpResolver');
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
