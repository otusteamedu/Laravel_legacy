<?php

namespace App\Services\News\Repositories;

use App\Services\Cache\CacheKeyManager;
use Cache;
use Illuminate\Http\Request;

class CachedNewsRepository
{
    const CACHE_SECOND = 180;
    private $newsRepository;
    private $cacheManager;

    public function __construct(
        EloquentNewsRepository $eloquentNewsRepository,
        CacheKeyManager $cacheKeyManager
    ) {
        $this->newsRepository = $eloquentNewsRepository;
        $this->cacheManager = $cacheKeyManager;
    }

    public function getListNews($time = null)
    {
        $key = $this->cacheManager->generateNewsKey();

        $time = (empty($time)) ? self::CACHE_SECOND : $time;

        return Cache::remember($key, self::CACHE_SECOND, function () {
            return $this->newsRepository->getAll();
        });
    }

    public function getFindId($id)
    {
        $key = $this->cacheManager->generateNewsKey($id);

        return Cache::remember($key, self::CACHE_SECOND, function () use ($id) {
            return $this->newsRepository->getId($id);
        });

    }


}
