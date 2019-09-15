<?php

declare(strict_types=1);

namespace App\Services\Locations\Interfaces;

use App\Models\Location;
use App\Models\User;
use App\Models\Workout;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface LocationRepositoryInterface
 *
 * @package App\Repositories\Interfaces
 * @todo Добавить тайпхинты для возвращаемых значений
 * @todo Разбить интерфейс на несколько интерфейсов для соответствия ISP
 */
interface LocationRepositoryInterface
{
    /**
     * Get all of the records from the database.
     *
     * @param  array  $columns
     * @return Collection|static[]
     */
    public function all(array $columns = ['*']);

    /**
     * Paginate the given query.
     *
     * @param  int  $perPage
     * @param  array  $columns
     * @return Collection|static[]
     */
    public function paginate(int $perPage = 15, array $columns = ['*']);

    /**
     * Find a record by its primary key.
     *
     * @param  int  $id
     * @return Location|Collection|static[]|static|null
     */
    public function find(int $id);

    /**
     * Find a record by an attribute/value.
     *
     * @param  string  $attribute
     * @param  string  $value
     * @return Location|Collection|static[]|static|null
     */
    public function findBy(string $attribute, string $value);

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

    /**
     * Find a record by User.
     *
     * @param  User  $user
     * @return Location|Collection|static[]|static|null
     */
    public function getByUser(User $user);

    /**
     * Find a record by Workout.
     *
     * @param  Workout  $workout
     * @return Location|Collection|static[]|static|null
     */
    public function getByWorkout(Workout $workout);
}
