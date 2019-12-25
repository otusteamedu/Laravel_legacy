<?php

declare(strict_types=1);

namespace App\Services\Cache;

use App\Models\Location;
use App\Models\User;
use App\Models\Workout;
use App\Services\Cache\Interfaces\CacheServiceInterface;
use App\Services\Location\LocationService;
use App\Services\Workout\WorkoutService;

class CacheService implements CacheServiceInterface
{

    const CACHE_TTL = 600;

    const USER_CACHE_TAG_PREFIXES = [
        Location::class => 'Location.User:',
        Workout::class => 'Workout.User:',
    ];

    /**
     * @var LocationService
     */
    private $locationService;

    /**
     * @var WorkoutService
     */
    private $workoutService;

    /**
     * CacheService constructor.
     * @param  LocationService  $locationService
     * @param  WorkoutService  $workoutService
     */
    public function __construct(LocationService $locationService, WorkoutService $workoutService)
    {
        $this->locationService = $locationService;
        $this->workoutService = $workoutService;
    }

    /**
     * Get cache key for given params.
     *
     * @param  array  $params
     * @return string
     */
    public static function getCacheKey(array $params = []): string
    {
        return 'cache.params:'.http_build_query($params);
    }

    /**
     * Get cache user tag for given Model.
     *
     * @param  string  $modelClass
     * @return string
     */
    public static function getCacheUserTagByModel(string $modelClass): string
    {
        return self::USER_CACHE_TAG_PREFIXES[$modelClass];
    }

    /**
     * Warmup cache for user.
     *
     * @param  User  $user
     */
    public function warmupCacheByUser(User $user): void
    {
        $this->locationService->warmupCacheByUser($user);
        $this->workoutService->warmupCacheByUser($user);
    }
}
