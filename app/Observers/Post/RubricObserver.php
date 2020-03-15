<?php

namespace App\Observers\Post;

use App\Models\Post\Rubric;
use App\Services\Cache\CacheService;
use Illuminate\Support\Facades\Cache;

class RubricObserver
{
    /**
     * @param Rubric $rubric
     */
    public function created(Rubric $rubric): void
    {
        $this->clearCache($rubric);
    }

    /**
     * @param Rubric $rubric
     */
    public function updated(Rubric $rubric): void
    {
        $this->clearCache($rubric);
    }

    /**
     * @param Rubric $rubric
     */
    public function deleted(Rubric $rubric): void
    {
        $this->clearCache($rubric);
        $this->clearPostList($rubric);
    }

    /**
     * @param Rubric $rubric
     */
    protected function clearCache(Rubric $rubric): void
    {
        $cacheName = CacheService::makePageName($rubric->slug);
        Cache::tags(CacheService::CACHE_TAGS['rubric'])
            ->forget($cacheName);

        Cache::tags([CacheService::CACHE_TAGS['menu']])
            ->forget(CacheService::CACHE_TAGS['rubric']);
    }

    /**
     * @param Rubric $rubric
     */
    protected function clearPostList(Rubric $rubric)
    {
        Cache::tags([
            CacheService::CACHE_TAGS['post'],
            CacheService::CACHE_TAGS['rubric'],
            $rubric->id
        ])->flush();
    }
}
