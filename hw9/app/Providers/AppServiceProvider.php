<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;


use App\Http\Controllers\Admin\UsersController;

//use App\Providers\Views\BladeStatements;
use App\Services\Users\Repositories\UserRepositoryInterface;
use App\Services\Users\Repositories\EloquentUserRepository;
use App\Services\Roles\Repositories\RoleRepositoryInterface;
use App\Services\Roles\Repositories\EloquentRoleRepository;
use App\Services\Permissions\Repositories\PermissionRepositoryInterface;
use App\Services\Permissions\Repositories\EloquentPermissionRepository;
use App\Services\Statuses\Repositories\StatusRepositoryInterface;
use App\Services\Statuses\Repositories\EloquentStatusRepository;
use App\Services\Tasks\Repositories\TaskRepositoryInterface;

use App\Services\Tasks\Repositories\EloquentTaskRepository;
use App\Services\Tasks\Repositories\CachedTaskRepositoryInterface;
use App\Services\Tasks\Repositories\CachedTaskRepository;
use App\Services\Users\Repositories\CachedUserRepositoryInterface;
use App\Services\Users\Repositories\CachedUserRepository;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, EloquentRoleRepository::class);
        $this->app->bind(PermissionRepositoryInterface::class, EloquentPermissionRepository::class);
        $this->app->bind(StatusRepositoryInterface::class, EloquentStatusRepository::class);
        $this->app->bind(TasksRepositoryInterface::class, EloquentTasksRepository::class);
        $this->app->bind(CachedUserRepositoryInterface::class, CachedUserRepository::class);

        $this->app->bind(CachedTaskRepositoryInterface::class, CachedTaskRepository::class);
        $this->app->bind(TaskRepositoryInterface::class, EloquentTaskRepository::class);


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
