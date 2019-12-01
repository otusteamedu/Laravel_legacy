<?php

namespace App\Services\Favorites\Repositories;

use App\Services\Cache\CacheKeyManager;
use App\Services\Cache\Tag;
use Cache;

class CachedFavoriteRepository implements CachedFavoriteRepositoryInterface {

    const CACHE_SEARCH_SECONDS = 3600;

    /** @var FavoriteRepositoryInterface */
    private $favoriteRepository;

    /** @var CacheKeyManager */
    private $cacheKeyManager;

    public function __construct(FavoriteRepositoryInterface $favoriteRepository, CacheKeyManager $cacheKeyManager) {
        $this->favoriteRepository = $favoriteRepository;
        $this->cacheKeyManager = $cacheKeyManager;
    }

    public function search(array $filters = [], array $with = []) {
        $key = $this->cacheKeyManager->getSearchFavoritesKey($filters);
        $result =  Cache::tags([Tag::FAVORITES])
            ->remember($key, self::CACHE_SEARCH_SECONDS, function () use ($filters, $with) {
                return $this->favoriteRepository->search($filters, $with);
            });

        return $result;
    }

    public function clearSearchCache() {
        Cache::tags([Tag::FAVORITES])->flush();
    }
}
