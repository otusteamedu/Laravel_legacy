<?php

declare(strict_types=1);

namespace App\Services\Location\Interfaces;

use App\Models\Location;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface LocationCachedRepositoryInterface
 *
 * @package App\Repositories\Interfaces
 * @todo Добавить тайпхинты для возвращаемых значений
 * @todo Разбить интерфейс на несколько меньших интерфейсов для соответствия ISP
 */
interface LocationCachedRepositoryInterface
{
    /**
     * Find and paginate a cached collection of records.
     *
     * @param  array  $conditions
     * @param  array  $filters
     * @return Location|Collection|static[]|static|null
     */
    public function searchCached(array $conditions = [], array $filters = []);

}
