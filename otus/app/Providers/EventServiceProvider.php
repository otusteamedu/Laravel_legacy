<?php

namespace App\Providers;

use App\Listeners\Cache\Author\ClearAuthorCache;
use App\Listeners\Cache\Category\ClearCategoryCache;
use App\Listeners\Cache\Compilation\ClearCompilationCache;
use App\Listeners\Cache\Favorite\ClearFavoriteCache;
use App\Services\Events\Models\Author\AuthorSaved;
use App\Services\Events\Models\Category\CategorySaved;
use App\Services\Events\Models\Compilation\CompilationSaved;
use App\Services\Events\Models\Favorite\FavoriteSaved;
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
        CategorySaved::class =>  [
            ClearCategoryCache::class,
        ],
        AuthorSaved::class =>  [
            ClearAuthorCache::class,
        ],
        CompilationSaved::class =>  [
            ClearCompilationCache::class,
        ],
        FavoriteSaved::class =>  [
            ClearFavoriteCache::class,
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
