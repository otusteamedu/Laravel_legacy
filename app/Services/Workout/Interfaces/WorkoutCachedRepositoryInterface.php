<?php

declare(strict_types=1);

namespace App\Services\Workout\Interfaces;

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
     * @return Workout|Collection|static[]|static|null
     */
    public function searchCached(array $conditions = [], array $filters = []);

}
