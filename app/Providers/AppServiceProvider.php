<?php

namespace App\Providers;

use App\Services\Countries\Repositories\CountryRepositoryInterface;
use App\Services\Countries\Repositories\EloquentCountryRepository;
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
        $this->registerBindings();
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

    private function registerBindings(){
        $this->app->bind(
            CountryRepositoryInterface::class,
            EloquentCountryRepository::class
        );
    }
}
