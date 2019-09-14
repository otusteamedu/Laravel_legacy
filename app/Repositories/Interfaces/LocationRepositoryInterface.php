<?php

namespace App\Repositories\Interfaces;

use App\Models\Location;
use App\Models\User;
use App\Models\Workout;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface LocationRepositoryInterface
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
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all(array $columns = ['*']);

    /**
     * Paginate the given query.
     *
     * @param  int  $perPage
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function paginate(int $perPage = 15, array $columns = ['*']);

    /**
     * Find a record by its primary key.
     *
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|static[]|static|null
     */
    public function find(int $id);

    /**
     * Find a record by an attribute/value.
     *
     * @param  string  $attribute
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|static[]|static|null
     */
    public function findBy(string $attribute, string $value);

    /**
     * Create a record and fill it with values.
     *
     * @param  array  $data
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function create(array $data);

    /**
     * Update a record and fill it with values.
     *
     * @param  Location  $location
     * @param  array  $data
     * @return \Illuminate\Database\Eloquent\Model|static
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
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|static[]|static|null
     */
    public function getByUser(User $user);

    /**
     * Find a record by Workout.
     *
     * @param  Workout  $workout
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|static[]|static|null
     */
    public function getByWorkout(Workout $workout);
}
