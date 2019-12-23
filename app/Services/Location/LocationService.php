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
     * Find and paginate a collection of records.
     *
     * @param  array  $conditions
     * @return Location|Collection|static[]|static|null
     */
    public function search(array $conditions = [])
    {
        return $this->locationRepository->search($conditions);
    }

    /**
     * Find a record by its primary key.
     *
     * @param  int  $id
     * @return Location|Collection|static[]|static|null
     */
    public function findById(int $id)
    {
        return $this->locationRepository->findById($id);
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
     * @throws \Exception
     */
    public function delete(Location $location)
    {
        return $this->locationRepository->delete($location);
    }

    /**
     * Find all of the records by User.
     *
     * @param  User  $user
     * @return Location|Collection|static[]|static|null
     */
    public function getByUser(User $user)
    {
        return $this->search(['user_id' => $user->id]);
    }

    /**
     * Find all of the records by Workout.
     *
     * @param  Workout  $workout
     * @return Location|Collection|static[]|static|null
     */
    public function getByWorkout(Workout $workout)
    {
        // TODO
    }
}
