<?php

namespace Tests\Unit\Services\Cache;

use App\Services\Cache\CacheService;
use Tests\TestCase;

class CacheKeyServiceTest extends TestCase
{

    /**
     * Test CacheService::getCacheKey() method.
     *
     * @return void
     */
    public function testGetCacheKey(): void {
        $params = [
            'page' => 1
        ];
        $cacheKey = CacheService::getCacheKey($params);
        $this->assertEquals('cache.params:page=1', $cacheKey);
    }

}
