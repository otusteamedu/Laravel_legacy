<?php

namespace App\Providers;

use App\Services\Counterparty\Repositories\CounterpartyRepositoryInterface;
use App\Services\Counterparty\Repositories\EloquentCounterpartyRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $repositories = [
        CounterpartyRepositoryInterface::class => EloquentCounterpartyRepository::class,
    ];

    /**
     * Register any application services.
     */
    public function register()
    {
        foreach ($this->repositories as $interface => $class) {
            $this->app->bind($interface, $class, true);
        }

        $this->app->resolving('url', function () {
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
    }
}
