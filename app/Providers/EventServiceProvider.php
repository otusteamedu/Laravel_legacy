<?php

namespace App\Providers;

use App\Events\Models\Products\CreatProductsEvent;
use App\Events\Models\Wishlist\DeletedWishlistEvent;
use App\Events\Models\Wishlist\SavedWishlistEvent;
use App\Listeners\Cache\ClearWishlistsCache;
use App\Listeners\Cache\WarmProductsCache;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        SavedWishlistEvent::class => [
            ClearWishlistsCache::class,
        ],
        DeletedWishlistEvent::class => [
            ClearWishlistsCache::class,
        ],
        CreatProductsEvent::class => [
            WarmProductsCache::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        //
    }
}
