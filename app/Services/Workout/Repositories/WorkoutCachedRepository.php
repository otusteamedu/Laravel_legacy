<?php

declare(strict_types=1);

namespace App\Services\Workout\Repositories;

use App\Models\User;
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
     *   - user_id
     * @param  array  $filters
     * @param  string  $path
     * @return Workout|Collection|static[]|static|null
     */
    public function searchCached(array $conditions = ['user_id' => 0], array $filters = [], string $path = '')
    {
        $cacheKey = CacheService::getCacheKey(array_merge($conditions, $filters));

        return Cache::tags([
            'Workout.User:'.$conditions['user_id']
        ])->remember(
            $cacheKey,
            CacheService::CACHE_TTL,
            function () use ($conditions, $filters, $path) {
                return $this->workoutRepository->search($conditions, $filters, $path);
            }
        );
    }

    /**
     * Clear search cache.
     *
     * @param  array  $conditions
     *   - user_id
     */
    public function clearSearchCache(array $conditions = ['user_id' => 0])
    {
        Cache::tags([
            'Workout.User:'.$conditions['user_id']
        ])->flush();
    }

    /**
     * @inheritDoc
     */
    public function warmupCacheByUser(User $user)
    {
        $conditions = [
            'user_id' => $user->id
        ];
        $filters = [];
        // @todo Прогревать кэш для всех страниц
        $this->searchCached($conditions, $filters, route('backend.workout.index'));
    }

}
