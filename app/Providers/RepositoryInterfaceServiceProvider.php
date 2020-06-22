<?php

namespace App\Providers;

use App\Services\Order\Repositories\EloquentOrderRepository;
use App\Services\Order\Repositories\OrderRepositoryInterface;
use App\Services\OrderStatus\Repositories\EloquentOrderStatusRepository;
use App\Services\OrderStatus\Repositories\OrderStatusRepositoryInterface;
use App\Services\Product\Repositories\EloquentProductRepository;
use App\Services\Product\Repositories\ProductRepositoryInterface;
use App\Services\User\Repositories\EloquentUserRepository;
use App\Services\User\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryInterfaceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(OrderRepositoryInterface::class, function () {
            return new EloquentOrderRepository();
        });

        $this->app->bind(OrderStatusRepositoryInterface::class, function () {
            return new EloquentOrderStatusRepository();
        });

        $this->app->bind(ProductRepositoryInterface::class, function () {
            return new EloquentProductRepository();
        });

        $this->app->bind(UserRepositoryInterface::class, function() {
            return new EloquentUserRepository();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
