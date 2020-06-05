<?php


namespace App\Services\Cache;
use App\Services\Cache\Handlers\CacheWarmupHandler;

class CachesService
{

    /**
     * @var CacheWarmupHandler
     */
    private CacheWarmupHandler $cacheWarmupHandler;

    public function __construct(CacheWarmupHandler $cacheWarmupHandler)
    {

        $this->cacheWarmupHandler = $cacheWarmupHandler;
    }

    public function warmup()
    {
        $this->cacheWarmupHandler->handler([]);
    }

}
