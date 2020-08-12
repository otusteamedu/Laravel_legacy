<?php

namespace App\Providers;

use App\Models\Business;
use App\Observers\BusinessObserver;
use Illuminate\Support\ServiceProvider;

/**
 * Наблюдатели
 * Class ObserverServiceProvider
 * @package App\Providers
 */
class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Business::observe(BusinessObserver::class);
    }
}
