<?php

declare(strict_types=1);

namespace App\Services\Workout\Repositories;

use App\Services\Workout\Interfaces\WorkoutRepositoryInterface;
use App\Models\Workout;
use Illuminate\Database\Eloquent\Collection;

class WorkoutRepository implements WorkoutRepositoryInterface {

    /**
     * Get all of the records from the database.
     *
     * @param  array  $columns
     * @return Collection|static[]
     */
    public function all(array $columns = ['*'])
    {
        return Workout::all($columns);
    }

    /**
     * Paginate the given query.
     *
     * @param  int  $perPage
     * @param  array  $columns
     * @return Collection|static[]
     */
    public function paginate(int $perPage = 15, array $columns = ['*'])
    {
        return Workout::paginate($perPage, $columns);
    }

    /**
     * Find a record by its primary key.
     *
     * @param  int  $id
     * @return Workout|Collection|static[]|static|null
     */
    public function find(int $id)
    {
        // TODO: Implement find() method.
    }

    /**
     * Find a record by an attribute/value.
     *
     * @param  string  $attribute
     * @param  string  $value
     * @return Workout|Collection|static[]|static|null
     */
    public function findBy(string $attribute, string $value)
    {
        // TODO: Implement findBy() method.
    }

    /**
     * Create a record and fill it with values.
     *
     * @param  array  $data
     * @return Workout|static
     */
    public function create(array $data)
    {
        $workout = new Workout();
        $workout->create($data);
        return $workout;
    }

    /**
     * Update a record and fill it with values.
     *
     * @param  Workout  $workout
     * @param  array  $data
     * @return Workout|static
     */
    public function update(Workout $workout, array $data)
    {
        $workout->update($data);
        return $workout;
    }

    /**
     * Delete a record from the database.
     *
     * @param  Workout  $workout
     * @return mixed
     * @throws \Exception
     */
    public function delete(Workout $workout)
    {
        return $workout->delete();
    }

}
