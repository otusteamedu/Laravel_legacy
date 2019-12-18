<?php

namespace App\Services\Authors\Repositories;

use App\Services\Cache\CacheKeyManager;
use App\Services\Cache\Tag;
use Cache;

class CachedAuthorRepository implements CachedAuthorRepositoryInterface {

    const CACHE_SEARCH_SECONDS = 3600;

    /** @var AuthorRepositoryInterface */
    private $authorRepository;

    /** @var CacheKeyManager */
    private $cacheKeyManager;

    public function __construct(AuthorRepositoryInterface $authorRepository, CacheKeyManager $cacheKeyManager) {
        $this->authorRepository = $authorRepository;
        $this->cacheKeyManager = $cacheKeyManager;
    }

    public function search(array $filters = [], array $with = []) {
        $key = $this->cacheKeyManager->getSearchAuthorsKey($filters);
        $result =  Cache::tags([Tag::AUTHORS])
            ->remember($key, self::CACHE_SEARCH_SECONDS, function () use ($filters, $with) {
                return $this->authorRepository->search($filters, $with);
            });

        return $result;
    }

    public function clearSearchCache() {
        Cache::tags([Tag::AUTHORS])->flush();
    }
}
