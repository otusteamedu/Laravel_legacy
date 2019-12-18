<?php

namespace App\Services\SelectionMaterials\Repositories;

use App\Services\Cache\CacheKeyManager;
use App\Services\Cache\Tag;
use Cache;

class CachedSelectionMaterialRepository implements CachedSelectionMaterialRepositoryInterface {

    const CACHE_SEARCH_SECONDS = 3600;

    /** @var SelectionMaterialsRepositoryInterface */
    private $selectionMaterialRepository;

    /** @var CacheKeyManager */
    private $cacheKeyManager;

    public function __construct(SelectionMaterialsRepositoryInterface $selectionMaterialRepository, CacheKeyManager $cacheKeyManager) {
        $this->selectionMaterialRepository = $selectionMaterialRepository;
        $this->cacheKeyManager = $cacheKeyManager;
    }

    public function search(array $filters = [], array $with = []) {
        $key = $this->cacheKeyManager->getSearchSelectionMaterialsKey($filters);
        $result =  Cache::tags([Tag::SELECTION_MATERIALS])
            ->remember($key, self::CACHE_SEARCH_SECONDS, function () use ($filters, $with) {
                return $this->selectionMaterialRepository->search($filters, $with);
            });

        return $result;
    }

    public function clearSearchCache() {
        Cache::tags([Tag::SELECTION_MATERIALS])->flush();
    }
}
