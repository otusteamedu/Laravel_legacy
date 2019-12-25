<?php

declare(strict_types=1);

namespace App\Services\Workout\Interfaces;

use App\Models\User;
use App\Models\Workout;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface WorkoutRepositoryInterface
 *
 * @package App\Repositories\Interfaces
 * @todo Добавить тайпхинты для возвращаемых значений
 * @todo Разбить интерфейс на несколько меньших интерфейсов для соответствия ISP
 */
interface WorkoutCachedRepositoryInterface
{
    /**
     * Find and paginate a cached collection of records.
     *
     * @param  array  $conditions
     * @param  array  $filters
     * @param  string  $path
     * @return Workout|Collection|static[]|static|null
     */
    public function searchCached(array $conditions = [], array $filters = [], string $path = '');

    /**
     * Clear search cache.
     *
     * @param  array  $conditions
     *   - user_id
     */
    public function clearSearchCache(array $conditions = ['user_id' => 0]);

    /**
     * Warmup cache by user.
     *
     * @param  User  $user
     * @return mixed
     */
    public function warmupCacheByUser(User $user);

}
