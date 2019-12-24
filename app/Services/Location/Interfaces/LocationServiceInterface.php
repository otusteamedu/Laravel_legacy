<?php

declare(strict_types=1);

namespace App\Services\Location\Interfaces;

use App\Models\Location;
use App\Models\User;
use App\Models\Workout;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface LocationServiceInterface
 */
interface LocationServiceInterface extends LocationRepositoryInterface
{
    /**
     * Find records by User.
     *
     * @param  User  $user
     * @param  array  $filters
     * @return Location|Collection|static[]|static|null
     */
    public function getByUser(User $user, array $filters = []);

    /**
     * Find cached records by User.
     *
     * @param  User  $user
     * @param  array  $filters
     * @return Location|Collection|static[]|static|null
     */
    public function getByUserCached(User $user, array $filters = []);

    /**
     * Find a record by Workout.
     *
     * @param  Workout  $workout
     * @return Location|Collection|static[]|static|null
     */
    public function getByWorkout(Workout $workout);

}
