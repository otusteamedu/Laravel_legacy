<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Constructions\Repositories\ConstructionRepositoryInterface;
use App\Services\Constructions\Repositories\EloquentConstructionRepository;
use App\Services\ConstructionTypes\Repositories\ConstructionTypesRepositoryInterface;
use App\Services\ConstructionTypes\Repositories\EloquentConstructionTypesRepository;

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


    }
}
