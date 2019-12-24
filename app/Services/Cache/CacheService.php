<?php

declare(strict_types=1);

namespace App\Services\Cache;

use App\Services\Cache\Interfaces\CacheServiceInterface;

class CacheService implements CacheServiceInterface
{

    const CACHE_TTL = 600;

    public static function getCacheKey(array $params = []): string
    {
        return 'cache.params:'.http_build_query($params);
    }
}
