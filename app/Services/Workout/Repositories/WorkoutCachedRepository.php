<?php

declare(strict_types=1);

namespace App\Services\Workout\Repositories;

use App\Services\Cache\CacheService;
use App\Services\Workout\Interfaces\WorkoutCachedRepositoryInterface;
use App\Models\Workout;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class WorkoutCachedRepository implements WorkoutCachedRepositoryInterface {

    /**
     * @var WorkoutRepository $workoutRepository
     */
    private $workoutRepository;

    public function __construct(WorkoutRepository $workoutRepository)
    {
        $this->workoutRepository = $workoutRepository;
    }

    /**
     * Find and paginate a cached collection of records.
     *
     * @param  array  $conditions
     * @param  array  $filters
     * @return Workout|Collection|static[]|static|null
     */
    public function searchCached(array $conditions = [], array $filters = [])
    {
        $cacheKey = CacheService::getCacheKey(array_merge($conditions, $filters));
        return Cache::remember(
            $cacheKey,
            CacheService::CACHE_TTL,
            function () use ($conditions) {
                return $this->workoutRepository->search($conditions);
            }
        );
    }

}
