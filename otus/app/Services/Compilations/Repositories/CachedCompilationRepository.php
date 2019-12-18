<?php

namespace App\Services\Compilations\Repositories;

use App\Services\Cache\CacheKeyManager;
use App\Services\Cache\Tag;
use Cache;

class CachedCompilationRepository implements CachedCompilationRepositoryInterface {

    const CACHE_SEARCH_SECONDS = 3600;

    /** @var CompilationRepositoryInterface */
    private $compilationRepository;

    /** @var CacheKeyManager */
    private $cacheKeyManager;

    public function __construct(CompilationRepositoryInterface $compilationRepository, CacheKeyManager $cacheKeyManager) {
        $this->compilationRepository = $compilationRepository;
        $this->cacheKeyManager = $cacheKeyManager;
    }

    public function search(array $filters = [], array $with = []) {
        $key = $this->cacheKeyManager->getSearchCompilationsKey($filters);
        $result =  Cache::tags([Tag::COMPILATIONS])
            ->remember($key, self::CACHE_SEARCH_SECONDS, function () use ($filters, $with) {
                return $this->compilationRepository->search($filters, $with);
            });

        return $result;
    }

    public function clearSearchCache() {
        Cache::tags([Tag::COMPILATIONS])->flush();
    }
}
