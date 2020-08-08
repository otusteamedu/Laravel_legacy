<?php

namespace App\Providers;

use App\Services\Admin\Businesses\Repositories\BusinessRepositoryInterface as AdminBusinessRepositoryInterface;
use App\Services\Admin\Businesses\Repositories\EloquentBusinessRepository as AdminEloquentBusinessRepository;
use App\Services\Admin\BusinessTypes\Repositories\BusinessTypeRepositoryInterface as AdminBusinessTypeRepositoryInterface;
use App\Services\Admin\BusinessTypes\Repositories\EloquentBusinessTypeRepository as AdminEloquentBusinessTypeRepository;
use App\Services\Admin\Procedures\Repositories\EloquentProcedureRepository as AdminEloquentProcedureRepository;
use App\Services\Admin\Procedures\Repositories\ProcedureRepositoryInterface as AdminProcedureRepositoryInterface;

use App\Services\Businesses\Repositories\BusinessRepositoryInterface;
use App\Services\Businesses\Repositories\EloquentBusinessRepository;
use App\Services\BusinessTypes\Repositories\BusinessTypeRepositoryInterface;
use App\Services\BusinessTypes\Repositories\EloquentBusinessTypeRepository;
use App\Services\Localize\Repositories\LocalizeRepositoryInterface;
use App\Services\Localize\Repositories\SessionLocalizeRepository;
use App\Services\Procedures\Repositories\EloquentProcedureRepository;
use App\Services\Procedures\Repositories\ProcedureRepositoryInterface;
use App\Services\Records\Repositories\EloquentRecordRepository;
use App\Services\Records\Repositories\RecordRepositoryInterface;
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
        // Client
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(BusinessRepositoryInterface::class, EloquentBusinessRepository::class);
        $this->app->bind(BusinessTypeRepositoryInterface::class, EloquentBusinessTypeRepository::class);
        $this->app->bind(ProcedureRepositoryInterface::class, EloquentProcedureRepository::class);
        $this->app->bind(LocalizeRepositoryInterface::class, SessionLocalizeRepository::class);
        $this->app->bind(RecordRepositoryInterface::class, EloquentRecordRepository::class);

        // Admin
        $this->app->bind(AdminBusinessRepositoryInterface::class, AdminEloquentBusinessRepository::class);
        $this->app->bind(AdminBusinessTypeRepositoryInterface::class, AdminEloquentBusinessTypeRepository::class);
        $this->app->bind(AdminProcedureRepositoryInterface::class, AdminEloquentProcedureRepository::class);
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
