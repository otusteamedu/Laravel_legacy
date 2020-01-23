<?php

namespace App\Listeners\Cache;

use App\Services\Wishlists\Repositories\CachedWishlistsRepositoryInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ClearWishlistsCache
{

    protected $cachedWishlistsRepository;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(CachedWishlistsRepositoryInterface $cachedWishlistsRepository)
    {
       $this->cachedWishlistsRepository = $cachedWishlistsRepository;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $this->cachedWishlistsRepository->clearCache();
    }
}
