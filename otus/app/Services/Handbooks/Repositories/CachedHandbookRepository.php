<?php

namespace App\Services\Handbooks\Repositories;

use App\Services\Cache\CacheKeyManager;
use App\Services\Cache\Tag;
use Cache;

class CachedHandbookRepository implements CachedHandbookRepositoryInterface {

    const CACHE_SEARCH_SECONDS = 3600;

    /** @var HandbookRepositoryInterface */
    private $handbookRepository;

    /** @var CacheKeyManager */
    private $cacheKeyManager;

    public function __construct(HandbookRepositoryInterface $handbookRepository, CacheKeyManager $cacheKeyManager) {
        $this->handbookRepository = $handbookRepository;
        $this->cacheKeyManager = $cacheKeyManager;
    }

    public function search(array $filters = [], array $with = []) {
        $key = $this->cacheKeyManager->getSearchHandbooksKey($filters);
        $result =  Cache::tags([Tag::HANDBOOKS])
            ->remember($key, self::CACHE_SEARCH_SECONDS, function () use ($filters, $with) {
                return $this->handbookRepository->search($filters, $with);
            });

        return $result;
    }

    public function clearSearchCache() {
        Cache::tags([Tag::HANDBOOKS])->flush();
    }
}
