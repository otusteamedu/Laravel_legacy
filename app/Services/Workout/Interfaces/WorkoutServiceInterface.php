<?php

declare(strict_types=1);

namespace App\Services\Workout\Interfaces;

use App\Models\Location;
use App\Models\Workout;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface WorkoutServiceInterface
 */
interface WorkoutServiceInterface extends WorkoutRepositoryInterface
{
    /**
     * Find a record by User.
     *
     * @param  User  $user
     * @return Workout|Collection|static[]|static|null
     */
    public function getByUser(User $user);

    /**
     * Find a record by Location.
     *
     * @param  Location  $location
     * @return Workout|Collection|static[]|static|null
     */
    public function getByLocation(Location $location);

}
