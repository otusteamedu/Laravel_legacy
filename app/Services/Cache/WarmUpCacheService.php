<?php

namespace App\Services\Cache;


use App\Services\Events\Cache\WarmUpCacheEventsService;
use App\Services\Languages\Cache\WarmUpCacheLanguagesService;

class WarmUpCacheService
{
    private $warmUpCacheEventsService;
    private $warmUpCacheLanguagesService;

    public function __construct(
       WarmUpCacheEventsService $warmUpCacheEventsService,
       WarmUpCacheLanguagesService $warmUpCacheLanguagesService
    ) {
        $this->warmUpCacheEventsService = $warmUpCacheEventsService;
        $this->warmUpCacheLanguagesService = $warmUpCacheLanguagesService;
    }

    public function warmAll()
    {
        $this->warmUpCacheEventsService->warmAll();
        $this->warmUpCacheLanguagesService->warmAll();
    }

    public function clearAll() {
        \Cache::flush();
    }

    public function clearByTag(string $tag = null) {
        \Cache::tags($tag)->flush();
    }
}
