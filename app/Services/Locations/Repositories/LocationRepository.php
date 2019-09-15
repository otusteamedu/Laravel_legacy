<?php

declare(strict_types=1);

namespace App\Services\Locations\Repositories;

use App\Services\Locations\Interfaces\LocationRepositoryInterface;
use App\Models\Location;
use App\Models\User;
use App\Models\Workout;
use Illuminate\Database\Eloquent\Collection;

class LocationRepository implements LocationRepositoryInterface {

    /**
     * Get all of the records from the database.
     *
     * @param  array  $columns
     * @return Collection|static[]
     */
    public function all(array $columns = ['*'])
    {
        return Location::all($columns);
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
        return Location::paginate($perPage, $columns);
    }

    /**
     * Find a record by its primary key.
     *
     * @param  int  $id
     * @return Location|Collection|static[]|static|null
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
     * @return Location|Collection|static[]|static|null
     */
    public function findBy(string $attribute, string $value)
    {
        // TODO: Implement findBy() method.
    }

    /**
     * Create a record and fill it with values.
     *
     * @param  array  $data
     * @return Location|static
     */
    public function create(array $data)
    {
        $location = new Location();
        $location->create($data);
        return $location;
    }

    /**
     * Update a record and fill it with values.
     *
     * @param  Location  $location
     * @param  array  $data
     * @return Location|static
     */
    public function update(Location $location, array $data)
    {
        $location->update($data);
        return $location;
    }

    /**
     * Delete a record from the database.
     *
     * @param  Location  $location
     * @return mixed
     * @throws \Exception
     */
    public function delete(Location $location)
    {
        return $location->delete();
    }

    /**
     * Find a record by User.
     *
     * @param  User  $user
     * @return Location|Collection|static[]|static|null
     */
    public function getByUser(User $user)
    {
        // TODO: Implement getByUser() method.
    }

    /**
     * Find a record by Workout.
     *
     * @param  Workout  $workout
     * @return Location|Collection|static[]|static|null
     */
    public function getByWorkout(Workout $workout)
    {
        // TODO: Implement getByWorkout() method.
    }

}
