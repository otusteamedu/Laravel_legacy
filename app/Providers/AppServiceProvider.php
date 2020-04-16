<?php

namespace App\Providers;

use App\Http\Services\Localize\LocalizeService;
use App\Services\ViewControllerMethod;
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
        $this->app->bind('Localize', LocalizeService::class);
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

    private function registerBindings()
    {
        $this->app->singleton(ViewControllerMethod::class, ViewControllerMethod::class);
    }
}
