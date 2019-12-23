<?php

declare(strict_types=1);

namespace App\Services\Workout;

use App\Models\Location;
use App\Services\Workout\Interfaces\WorkoutServiceInterface;
use App\Models\Workout;
use App\Models\User;
use App\Services\Workout\Repositories\WorkoutCachedRepository;
use App\Services\Workout\Repositories\WorkoutRepository;
use Illuminate\Database\Eloquent\Collection;

class WorkoutService implements WorkoutServiceInterface {

    /**
     * @var WorkoutRepository $workoutRepository
     */
    private $workoutRepository;

    /**
     * @var WorkoutCachedRepository $workoutCachedRepository
     */
    private $workoutCachedRepository;

    /**
     * WorkoutService constructor.
     *
     * @param  WorkoutRepository  $workoutRepository
     * @param  WorkoutCachedRepository  $workoutCachedRepository
     */
    public function __construct(WorkoutRepository $workoutRepository, WorkoutCachedRepository $workoutCachedRepository)
    {
        $this->workoutRepository = $workoutRepository;
        $this->workoutCachedRepository = $workoutCachedRepository;
    }

    /**
     * Find and paginate a collection of records.
     *
     * @param  array  $conditions
     * @return Workout|Collection|static[]|static|null
     */
    public function search(array $conditions = [])
    {
        return $this->workoutRepository->search($conditions);
    }

    /**
     * Find and paginate a collection of records.
     *
     * @param  array  $conditions
     * @return Workout|Collection|static[]|static|null
     */
    public function searchCached(array $conditions = [])
    {
        return $this->workoutCachedRepository->searchCached($conditions);
    }

    /**
     * Find a record by its primary key.
     *
     * @param  int  $id
     * @return Workout|Collection|static[]|static|null
     */
    public function findById(int $id)
    {
        return $this->workoutRepository->findById($id);
    }

    /**
     * Create a record and fill it with values.
     *
     * @param  array  $data
     * @return Workout|static
     */
    public function create(array $data)
    {
        return $this->workoutRepository->create($data);
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
        return $this->workoutRepository->update($workout, $data);
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
        return $this->workoutRepository->delete($workout);
    }

    /**
     * Find records by User.
     *
     * @param  User  $user
     * @return Workout|Collection|static[]|static|null
     */
    public function getByUser(User $user)
    {
        return $this->search(['user_id' => $user->id]);
    }

    /**
     * Find cached records by User.
     *
     * @param  User  $user
     * @return Workout|Collection|static[]|static|null
     */
    public function getByUserCached(User $user)
    {
        return $this->searchCached(['user_id' => $user->id]);
    }

    /**
     * Find records by Location.
     *
     * @param  Location  $location
     * @return Workout|Collection|static[]|static|null
     */
    public function getByLocation(Location $location)
    {
        // TODO
    }
}
