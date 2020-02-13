<?php

namespace App\Providers;

use App\Services\Cache\CacheManager;
use App\Services\Cache\CacheManagerInterface;
use App\Services\Commands\Games\Hangman\Repositories\ConsoleHangmanRepository;
use App\Services\Commands\Games\Hangman\Repositories\ConsoleHangmanRepositoryInterface;
use App\Services\Products\Repositories\EloquentProductsRepository;
use App\Services\Products\Repositories\CachedProductsRepository;
use App\Services\Products\Repositories\CachedProductsRepositoryInterface;
use App\Services\Users\Repositories\EloquentUsersRepository;
use App\Services\Users\Repositories\UsersRepositoryInterface;
use App\Services\Wishlists\Repositories\CachedWishlistsRepository;
use App\Services\Wishlists\Repositories\CachedWishlistsRepositoryInterface;
use App\Services\Wishlists\Repositories\EloquentWishlistsRepository;
use App\Services\Products\Repositories\ProductsRepositoryInterface;
use App\Services\Wishlists\Repositories\WishlistsRepositoryInterface;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);
    }

    private function registerBindings()
    {
        $this->app->bind(ProductsRepositoryInterface::class, EloquentProductsRepository::class);
        $this->app->bind(UsersRepositoryInterface::class, EloquentUsersRepository::class);
        $this->app->bind(WishlistsRepositoryInterface::class, EloquentWishlistsRepository::class);
        $this->app->bind(CachedWishlistsRepositoryInterface::class, CachedWishlistsRepository::class);
        $this->app->bind(CacheManagerInterface::class, CacheManager::class);
        $this->app->bind(CachedProductsRepositoryInterface::class, CachedProductsRepository::class);
        $this->app->bind(ConsoleHangmanRepositoryInterface::class, ConsoleHangmanRepository::class);
    }
}
