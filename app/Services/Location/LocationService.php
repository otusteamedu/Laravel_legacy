<?php

declare(strict_types=1);

namespace App\Services\Location;

use App\Services\Location\Interfaces\LocationServiceInterface;
use App\Models\Location;
use App\Models\User;
use App\Models\Workout;
use App\Services\Location\Repositories\LocationCachedRepository;
use App\Services\Location\Repositories\LocationRepository;
use Illuminate\Database\Eloquent\Collection;

class LocationService implements LocationServiceInterface
{

    /**
     * @var LocationRepository
     */
    private $locationRepository;

    /**
     * @var LocationCachedRepository $locationCachedRepository
     */
    private $locationCachedRepository;

    /**
     * LocationService constructor.
     *
     * @param  LocationRepository  $locationRepository
     * @param  LocationCachedRepository  $locationCachedRepository
     */
    public function __construct(
        LocationRepository $locationRepository,
        LocationCachedRepository $locationCachedRepository
    ) {
        $this->locationRepository = $locationRepository;
        $this->locationCachedRepository = $locationCachedRepository;
    }

    /**
     * Find and paginate a collection of records.
     *
     * @param  array  $conditions
     * @param  array  $filters
     * @param  string  $path
     * @return Location|Collection|static[]|static|null
     */
    public function search(array $conditions = [], array $filters = [], string $path = '')
    {
        return $this->locationRepository->search($conditions, $filters);
    }

    /**
     * Find and paginate a collection of records.
     *
     * @param  array  $conditions
     * @param  array  $filters
     * @param  string  $path
     * @return Location|Collection|static[]|static|null
     */
    public function searchCached(array $conditions = [], array $filters = [], string $path = '')
    {
        return $this->locationCachedRepository->searchCached($conditions, $filters);
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
     * @param  array  $filters
     * @return Location|Collection|static[]|static|null
     */
    public function getByUser(User $user, array $filters = [])
    {
        return $this->search(['user_id' => $user->id], $filters);
    }

    /**
     * Find cached records by User.
     *
     * @param  User  $user
     * @param  array  $filters
     * @return Location|Collection|static[]|static|null
     */
    public function getByUserCached(User $user, array $filters = [])
    {
        return $this->searchCached(['user_id' => $user->id], $filters);
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

    /**
     * @inheritDoc
     */
    public function clearSearchCache(array $conditions = ['user_id' => 0])
    {
        $this->locationCachedRepository->clearSearchCache($conditions);
    }

    /**
     * @inheritDoc
     */
    public function warmupCacheByUser(User $user)
    {
        $this->locationCachedRepository->warmupCacheByUser($user);
    }

}
