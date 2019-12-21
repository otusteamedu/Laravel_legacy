<?php

declare(strict_types=1);

namespace App\Services\Location\Interfaces;

use App\Models\Location;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface LocationRepositoryInterface
 *
 * @package App\Repositories\Interfaces
 * @todo Добавить тайпхинты для возвращаемых значений
 * @todo Разбить интерфейс на несколько меньших интерфейсов для соответствия ISP
 */
interface LocationRepositoryInterface
{
    /**
     * Find and paginate a collection of records.
     *
     * @param  array  $conditions
     * @return Location|Collection|static[]|static|null
     */
    public function search(array $conditions = []);

    /**
     * Find a record by its primary key.
     *
     * @param  int  $id
     * @return Location|Collection|static[]|static|null
     */
    public function findById(int $id);

    /**
     * Create a record and fill it with values.
     *
     * @param  array  $data
     * @return Location|static
     */
    public function create(array $data);

    /**
     * Update a record and fill it with values.
     *
     * @param  Location  $location
     * @param  array  $data
     * @return Location|static
     */
    public function update(Location $location, array $data);

    /**
     * Delete a record from the database.
     *
     * @param  Location  $location
     * @return mixed
     */
    public function delete(Location $location);

}
