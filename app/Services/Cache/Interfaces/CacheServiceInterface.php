<?php

declare(strict_types=1);

namespace App\Services\Cache\Interfaces;

interface CacheServiceInterface
{
    public static function getCacheKey(array $params = []): string;
}
