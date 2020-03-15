<?php

namespace App\Observers\Page;

use App\Models\Page\Page;
use App\Services\Cache\CacheService;
use Illuminate\Support\Facades\Cache;

class PageObserver
{
    public function created(Page $page): void
    {
        $this->clearCache($page);
    }

    public function updated(Page $page): void
    {
        $this->clearCache($page);
    }

    public function deleted(Page $page): void
    {
        $this->clearCache($page);
    }

    protected function clearCache(Page $page): void
    {
        $cacheName = CacheService::makePageName($page->slug);
        Cache::tags(CacheService::CACHE_TAGS['page'])
            ->forget($cacheName);

        Cache::tags([CacheService::CACHE_TAGS['menu']])
            ->forget(CacheService::CACHE_TAGS['menu']);
    }
}
