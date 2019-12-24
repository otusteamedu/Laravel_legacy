<?php

declare(strict_types=1);

namespace App\Services\Cache;

use App\Models\User;
use App\Services\Cache\Interfaces\CacheServiceInterface;
use App\Services\Location\LocationService;

class CacheService implements CacheServiceInterface
{

    const CACHE_TTL = 600;

    /**
     * @var LocationService
     */
    private $locationService;

    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    public static function getCacheKey(array $params = []): string
    {
        return 'cache.params:'.http_build_query($params);
    }

    public function warmupCacheByUser(User $user): void
    {
        $this->locationService->warmupCacheByUser($user);
    }
}
