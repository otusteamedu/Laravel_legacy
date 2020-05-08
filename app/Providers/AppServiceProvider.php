<?php

namespace App\Providers;

use App\Services\Categories\Repositories\EloquentCategoryRepository;
use App\Services\Categories\Repositories\CategoryRepositoryInterface;
use App\Services\Cities\Repositories\EloquentCityRepository;
use App\Services\Cities\Repositories\CityRepositoryInterface;
use App\Services\Offers\Repositories\EloquentOfferRepository;
use App\Services\Offers\Repositories\OfferRepositoryInterface;
use App\Services\Offers\Repositories\CachedOfferRepositoryInterface;
use App\Services\Offers\Repositories\CachedOfferRepository;
use App\Services\Projects\Repositories\EloquentProjectRepository;
use App\Services\Projects\Repositories\ProjectRepositoryInterface;
use App\Services\Segments\Repositories\EloquentSegmentRepository;
use App\Services\Segments\Repositories\SegmentRepositoryInterface;
use App\Services\Tariffs\Repositories\EloquentTariffRepository;
use App\Services\Tariffs\Repositories\TariffRepositoryInterface;
use App\Services\Countries\Repositories\CountryRepositoryInterface;
use App\Services\Countries\Repositories\EloquentCountryRepository;
use App\Services\Users\Repositories\EloquentUserRepository;
use App\Services\Users\Repositories\UserRepositoryInterface;
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
        $this->app->bind(
            CityRepositoryInterface::class,
            EloquentCityRepository::class
        );
        $this->app->bind(
            TariffRepositoryInterface::class,
            EloquentTariffRepository::class
        );

        $this->app->bind(
            SegmentRepositoryInterface::class,
            EloquentSegmentRepository::class
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            EloquentUserRepository::class
        );

        $this->app->bind(
            CategoryRepositoryInterface::class,
            EloquentCategoryRepository::class
        );

        $this->app->bind(
            ProjectRepositoryInterface::class,
            EloquentProjectRepository::class
        );

        $this->app->bind(
            OfferRepositoryInterface::class,
            EloquentOfferRepository::class
        );

        $this->app->bind(
            CachedOfferRepositoryInterface::class,
            CachedOfferRepository::class
        );
    }
}
