<?php

namespace App\Providers;

use App\Models\Advert;
use App\Observers\AdvertObserver;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\DuskServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
//        if ($this->app->environment('local', 'testing')) {
//            $this->app->register(DuskServiceProvider::class);
//        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Advert::observe(AdvertObserver::class);
    }
}
