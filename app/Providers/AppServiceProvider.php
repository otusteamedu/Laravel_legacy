<?php

namespace App\Providers;

use App\Models\Record;
use App\Models\User;
use App\Models\UserGroupRight;
use App\Observers\Group\UserGroupRightObserver;
use App\Observers\Record\RecordObserver;
use App\Observers\User\UserObserver;
use App\Services\Client\Repositories\ClientRepository;
use App\Services\Client\Repositories\ClientRepositoryInterface;
use App\Services\Record\Repositories\RecordRepository;
use App\Services\Record\Repositories\RecordRepositoryInterface;
use App\Services\UserGroup\UserGroupRepository;
use App\Services\UserGroup\UserGroupRepositoryInterface;
use App\Services\UserGroup\UserGroupRightRepository;
use App\Services\UserGroup\UserGroupRightRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(
            ClientRepositoryInterface::class,
            ClientRepository::class
        );

        $this->app->bind(
            RecordRepositoryInterface::class,
            RecordRepository::class
        );

        $this->app->bind(
            UserGroupRepositoryInterface::class,
            UserGroupRepository::class
        );

        $this->app->bind(
            UserGroupRightRepositoryInterface::class,
            UserGroupRightRepository::class
        );

        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
        UserGroupRight::observe($this->app->make(UserGroupRightObserver::class));
        Record::observe($this->app->make(RecordObserver::class));
    }
}
