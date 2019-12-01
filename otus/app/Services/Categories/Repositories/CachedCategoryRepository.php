<?php

namespace App\Services\Categories\Repositories;

use App\Services\Cache\CacheKeyManager;
use App\Services\Cache\Tag;
use Cache;

class CachedCategoryRepository implements CachedCategoryRepositoryInterface {

    const CACHE_SEARCH_SECONDS = 3600;

    /** @var CategoryRepositoryInterface */
    private $categoryRepository;

    /** @var CacheKeyManager */
    private $cacheKeyManager;

    public function __construct(CategoryRepositoryInterface $categoryRepository, CacheKeyManager $cacheKeyManager) {
        $this->categoryRepository = $categoryRepository;
        $this->cacheKeyManager = $cacheKeyManager;
    }

    public function search(array $filters = [], array $with = []) {
        $key = $this->cacheKeyManager->getSearchCategoriesKey($filters);
        $result =  Cache::tags([Tag::CATEGORIES])
            ->remember($key, self::CACHE_SEARCH_SECONDS, function () use ($filters, $with) {
                return $this->categoryRepository->search($filters, $with);
            });

        return $result;
    }

    public function clearSearchCache() {
        Cache::tags([Tag::CATEGORIES])->flush();
    }
}
