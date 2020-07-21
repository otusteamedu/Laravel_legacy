<?php

namespace App\Providers;

use App\Services\Businesses\Repositories\BusinessRepositoryInterface;
use App\Services\Businesses\Repositories\EloquentBusinessRepository;
use App\Services\BusinessTypes\Repositories\BusinessTypeRepositoryInterface;
use App\Services\BusinessTypes\Repositories\EloquentBusinessTypeRepository;
use App\Services\Procedures\Repositories\EloquentProcedureRepository;
use App\Services\Procedures\Repositories\ProcedureRepositoryInterface;
use App\Services\Users\Repositories\EloquentUserRepository;
use App\Services\Users\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(BusinessRepositoryInterface::class, EloquentBusinessRepository::class);
        $this->app->bind(BusinessTypeRepositoryInterface::class, EloquentBusinessTypeRepository::class);
        $this->app->bind(ProcedureRepositoryInterface::class, EloquentProcedureRepository::class);
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
