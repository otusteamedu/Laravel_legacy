<?php

namespace Tests\Unit\Services\Cache;

use App\Services\Cache\CacheKeyService;
use Tests\TestCase;

class CacheKeyServiceTest extends TestCase
{

    /**
     * Test CacheKeyService::getCacheKey() method.
     *
     * @return void
     */
    public function testGetCacheKey(): void {
        $params = [
            'page' => 1
        ];
        $cacheKey = CacheKeyService::getCacheKey($params);
        $this->assertEquals('cache.params:page=1', $cacheKey);
    }

}
