<?php

namespace App\Listeners\Cache\Favorite;

use App\Services\Favorites\Repositories\CachedFavoriteRepositoryInterface;

class ClearFavoriteCache {
    /**
     * @var CachedFavoriteRepositoryInterface
     */
    private $cachedFavoriteRepository;

    /**
     * ClearFavoriteCache constructor.
     * @param CachedFavoriteRepositoryInterface $cachedFavoriteRepository
     */
    public function __construct(CachedFavoriteRepositoryInterface $cachedFavoriteRepository) {
        $this->cachedFavoriteRepository = $cachedFavoriteRepository;
    }

    public function handle() {
        $this->cachedFavoriteRepository->clearSearchCache();
    }
}
