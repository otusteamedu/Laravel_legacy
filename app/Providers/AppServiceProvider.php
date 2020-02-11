<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        app()->bind(
            \App\Services\Countries\Repositories\CountryRepositoryInterface::class,
            \App\Services\Countries\Repositories\EloquentCountryRepository::class
        );

        app()->bind(
            \App\Services\Cities\Repositories\CityRepositoryInterface::class,
            \App\Services\Cities\Repositories\EloquentCityRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
