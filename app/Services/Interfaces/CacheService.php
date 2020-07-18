<?php

namespace App\Services\Interfaces;

/**
 * Interface CacheClear
 * @package App\Services\Interfaces
 */
interface CacheService
{
    public function clearCache(): void;

    public function cacheWarm(): void;
}
