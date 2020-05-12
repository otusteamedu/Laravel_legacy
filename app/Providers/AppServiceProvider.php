<?php

namespace App\Providers;

use App\Services\BaseServiceInterface;
use App\Services\Countries\Repositories\CountryRepositoryInterface;
use App\Services\Countries\Repositories\EloquentCountryRepository;
use App\Services\Currencies\Repositories\CurrencyRepositoryInterface;
use App\Services\Currencies\Repositories\EloquentCurrencyRepository;
use App\Services\Users\Repositories\UserRepositoryInterface;
use App\Services\Users\Repositories\EloquentUserRepository;
use App\Services\Income\Repositories\IncomeRepositoryInterface;
use App\Services\Income\Repositories\EloquentIncomeRepository;
use App\Services\Countries\Repositories\CachedCountryRepository;
use App\Services\Countries\Repositories\CachedCountryRepositoryInterface;
use App\Services\Currencies\Repositories\CachedCurrencyRepository;
use App\Services\Currencies\Repositories\CachedCurrencyRepositoryInterface;
use App\Services\Income\Repositories\CachedIncomeRepository;
use App\Services\Income\Repositories\CachedIncomeRepositoryInterface;
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
        $this->app->bind(CurrencyRepositoryInterface::class, EloquentCurrencyRepository::class);
        $this->app->bind(CountryRepositoryInterface::class, EloquentCountryRepository::class);
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(IncomeRepositoryInterface::class, EloquentIncomeRepository::class);
        $this->app->bind(CachedCountryRepositoryInterface::class, CachedCountryRepository::class);
        $this->app->bind(CachedCurrencyRepositoryInterface::class, CachedCurrencyRepository::class);
        $this->app->bind(CachedIncomeRepositoryInterface::class, CachedIncomeRepository::class);
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
