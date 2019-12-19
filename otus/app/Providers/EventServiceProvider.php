<?php

namespace App\Providers;

use App\Listeners\Cache\Author\ClearAuthorCache;
use App\Listeners\Cache\Category\ClearCategoryCache;
use App\Listeners\Cache\Compilation\ClearCompilationCache;
use App\Listeners\Cache\Favorite\ClearFavoriteCache;
use App\Listeners\Cache\Handbook\ClearHandbookCache;
use App\Listeners\Cache\Journal\ClearJournalCache;
use App\Listeners\Cache\Material\ClearMaterialCache;
use App\Listeners\Cache\Review\ClearReviewCache;
use App\Listeners\Cache\SelectionMaterial\ClearSelectionMaterialCache;
use App\Listeners\Cache\User\ClearUserCache;
use App\Services\Events\Models\Author\AuthorSaved;
use App\Services\Events\Models\Category\CategorySaved;
use App\Services\Events\Models\Compilation\CompilationSaved;
use App\Services\Events\Models\Favorite\FavoriteSaved;
use App\Services\Events\Models\Handbook\HandbookSaved;
use App\Services\Events\Models\Journal\JournalSaved;
use App\Services\Events\Models\Material\MaterialSaved;
use App\Services\Events\Models\Review\ReviewSaved;
use App\Services\Events\Models\SelectionMaterial\SelectionMaterialSaved;
use App\Services\Events\Models\User\UserSaved;
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
        HandbookSaved::class =>  [
            ClearHandbookCache::class,
        ],
        JournalSaved::class =>  [
            ClearJournalCache::class,
        ],
        MaterialSaved::class =>  [
            ClearMaterialCache::class,
        ],
        ReviewSaved::class =>  [
            ClearReviewCache::class,
        ],
        SelectionMaterialSaved::class =>  [
            ClearSelectionMaterialCache::class,
        ],
        UserSaved::class =>  [
            ClearUserCache::class,
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