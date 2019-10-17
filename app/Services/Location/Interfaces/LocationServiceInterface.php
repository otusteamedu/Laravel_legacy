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
     * Find a record by User.
     *
     * @param  User  $user
     * @return Location|Collection|static[]|static|null
     */
    public function getByUser(User $user);

    /**
     * Find a record by Workout.
     *
     * @param  Workout  $workout
     * @return Location|Collection|static[]|static|null
     */
    public function getByWorkout(Workout $workout);

}
