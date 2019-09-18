<?php

declare(strict_types=1);

namespace App\Services\Workout;

use App\Models\Location;
use App\Services\Workout\Interfaces\WorkoutServiceInterface;
use App\Models\Workout;
use App\Models\User;
use App\Services\Workout\Repositories\WorkoutRepository;
use Illuminate\Database\Eloquent\Collection;

class WorkoutService implements WorkoutServiceInterface {

    /**
     * @var WorkoutRepository
     */
    private $workoutRepository;

    /**
     * WorkoutService constructor.
     *
     * @param  WorkoutRepository  $workoutRepository
     */
    public function __construct(WorkoutRepository $workoutRepository)
    {
        $this->workoutRepository = $workoutRepository;
    }

    /**
     * Get all of the records from the database.
     *
     * @param  array  $columns
     * @return Collection|static[]
     */
    public function all(array $columns = ['*'])
    {
        return $this->workoutRepository->all($columns);
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
        return $this->workoutRepository->paginate($perPage, $columns);
    }

    /**
     * Find a record by its primary key.
     *
     * @param  int  $id
     * @return Workout|Collection|static[]|static|null
     */
    public function find(int $id)
    {
        return $this->workoutRepository->find($id);
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
        return $this->workoutRepository->findBy($attribute, $value);
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
     */
    public function delete(Workout $workout)
    {
        return $this->workoutRepository->delete($workout);
    }

    /**
     * Find a record by User.
     *
     * @param  User  $user
     * @return Workout|Collection|static[]|static|null
     */
    public function getByUser(User $user)
    {
        // TODO
    }

    /**
     * Find a record by Location.
     *
     * @param  Location  $location
     * @return Workout|Collection|static[]|static|null
     */
    public function getByLocation(Location $location)
    {
        // TODO
    }
}
