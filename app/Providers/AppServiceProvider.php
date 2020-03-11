<?php

namespace App\Providers;

use App\Services\BaseServiceInterface;
use App\Services\Countries\Repositories\CountryRepositoryInterface;
use App\Services\Countries\Repositories\EloquentCountryRepository;
use App\Services\Currencies\CurrenciesService;
use App\Services\Currencies\Repositories\CurrencyRepositoryInterface;
use App\Services\Currencies\Repositories\EloquentCurrencyRepository;
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
        $this->app->bind(BaseServiceInterface::class, CurrenciesService::class);
        $this->app->bind(CurrencyRepositoryInterface::class, EloquentCurrencyRepository::class);
        $this->app->bind(CountryRepositoryInterface::class, EloquentCountryRepository::class);
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
