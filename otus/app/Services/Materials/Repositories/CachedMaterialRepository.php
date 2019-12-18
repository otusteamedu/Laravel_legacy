<?php

namespace App\Services\Materials\Repositories;

use App\Services\Cache\CacheKeyManager;
use App\Services\Cache\Tag;
use Cache;

class CachedMaterialRepository implements CachedMaterialRepositoryInterface {

    const CACHE_SEARCH_SECONDS = 3600;

    /** @var MaterialsRepositoryInterface */
    private $materialRepository;

    /** @var CacheKeyManager */
    private $cacheKeyManager;

    public function __construct(MaterialsRepositoryInterface $materialRepository, CacheKeyManager $cacheKeyManager) {
        $this->materialRepository = $materialRepository;
        $this->cacheKeyManager = $cacheKeyManager;
    }

    public function search(array $filters = [], array $with = []) {
        $key = $this->cacheKeyManager->getSearchMaterialsKey($filters);
        $result =  Cache::tags([Tag::MATERIALS])
            ->remember($key, self::CACHE_SEARCH_SECONDS, function () use ($filters, $with) {
                return $this->materialRepository->search($filters, $with);
            });

        return $result;
    }

    public function clearSearchCache() {
        Cache::tags([Tag::MATERIALS])->flush();
    }
}
