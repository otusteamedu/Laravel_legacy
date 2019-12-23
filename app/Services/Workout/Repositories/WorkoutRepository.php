<?php

declare(strict_types=1);

namespace App\Services\Workout\Repositories;

use App\Services\Workout\Interfaces\WorkoutRepositoryInterface;
use App\Models\Workout;
use Illuminate\Database\Eloquent\Collection;

class WorkoutRepository implements WorkoutRepositoryInterface {

    /**
     * Find and paginate a collection of records.
     *
     * @param  array  $conditions
     * @return Workout|Collection|static[]|static|null
     */
    public function search(array $conditions = [])
    {
        return Workout::where($conditions)->with('user')->paginate();
    }

    /**
     * Find a record by its primary key.
     *
     * @param  int  $id
     * @return Workout|Collection|static[]|static|null
     */
    public function findById(int $id)
    {
        return Workout::find($id);
    }

    /**
     * Create a record and fill it with values.
     *
     * @param  array  $data
     * @return Workout|static
     */
    public function create(array $data)
    {
        return Workout::create($data);
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
