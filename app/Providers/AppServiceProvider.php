<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Constructions\Repositories\ConstructionRepositoryInterface;
use App\Services\Constructions\Repositories\EloquentConstructionRepository;
use App\Services\ConstructionTypes\Repositories\ConstructionTypesRepositoryInterface;
use App\Services\ConstructionTypes\Repositories\EloquentConstructionTypesRepository;
use App\Services\Constructions\Repositories\CachedConstructionRepository;
use App\Services\Constructions\Repositories\CachedConstructionRepositoryInterface;

use App\Repository\Cache\CacheTagRepository;
use App\Repository\Cache\CacheTagRepositoryInterface;
use App\Repository\Cache\CacheTimeRepository;
use App\Repository\Cache\CacheTimeRepositoryInterface;
use App\Repository\Cache\CacheKeyRepository;
use App\Repository\Cache\CacheKeyRepositoryInterface;


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

    private function registerBindings()
    {

        $this->app->bind(ConstructionRepositoryInterface::class, EloquentConstructionRepository::class);
        $this->app->bind(ConstructionTypesRepositoryInterface::class, EloquentConstructionTypesRepository::class);
        $this->app->bind(CachedConstructionRepositoryInterface::class,CachedConstructionRepository::class );
        $this->app->bind(CacheTimeRepositoryInterface::class,CacheTimeRepository::class);
        $this->app->bind(CacheKeyRepositoryInterface::class,CacheKeyRepository::class);
        $this->app->bind(CacheTagRepositoryInterface::class,CacheTagRepository::class);

    }
}
