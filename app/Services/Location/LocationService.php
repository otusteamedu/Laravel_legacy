<?php

declare(strict_types=1);

namespace App\Services\Location;

use App\Services\Location\Interfaces\LocationServiceInterface;
use App\Models\Location;
use App\Models\User;
use App\Models\Workout;
use App\Services\Location\Repositories\LocationRepository;
use Illuminate\Database\Eloquent\Collection;

class LocationService implements LocationServiceInterface {

    /**
     * @var LocationRepository
     */
    private $locationRepository;

    /**
     * LocationService constructor.
     *
     * @param  LocationRepository  $locationRepository
     */
    public function __construct(LocationRepository $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }

    /**
     * Get all of the records from the database.
     *
     * @param  array  $columns
     * @return Collection|static[]
     */
    public function all(array $columns = ['*'])
    {
        return $this->locationRepository->all($columns);
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
        return $this->locationRepository->paginate($perPage, $columns);
    }

    /**
     * Find a record by its primary key.
     *
     * @param  int  $id
     * @return Location|Collection|static[]|static|null
     */
    public function find(int $id)
    {
        return $this->locationRepository->find($id);
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
        return $this->locationRepository->findBy($attribute, $value);
    }

    /**
     * Create a record and fill it with values.
     *
     * @param  array  $data
     * @return Location|static
     */
    public function create(array $data)
    {
        return $this->locationRepository->create($data);
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
        return $this->locationRepository->update($location, $data);
    }

    /**
     * Delete a record from the database.
     *
     * @param  Location  $location
     * @return mixed
     */
    public function delete(Location $location)
    {
        return $this->locationRepository->delete($location);
    }

    /**
     * Find a record by User.
     *
     * @param  User  $user
     * @return Location|Collection|static[]|static|null
     */
    public function getByUser(User $user)
    {
        // TODO
    }

    /**
     * Find a record by Workout.
     *
     * @param  Workout  $workout
     * @return Location|Collection|static[]|static|null
     */
    public function getByWorkout(Workout $workout)
    {
        // TODO
    }
}
