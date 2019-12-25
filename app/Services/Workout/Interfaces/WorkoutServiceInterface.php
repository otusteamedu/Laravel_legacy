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
interface WorkoutServiceInterface extends WorkoutRepositoryInterface, WorkoutCachedRepositoryInterface
{
    /**
     * Find records by User.
     *
     * @param  User  $user
     * @param  array  $filters
     * @return Workout|Collection|static[]|static|null
     */
    public function getByUser(User $user, array $filters = []);

    /**
     * Find cached records by User.
     *
     * @param  User  $user
     * @param  array  $filters
     * @return Workout|Collection|static[]|static|null
     */
    public function getByUserCached(User $user, array $filters = []);

    /**
     * Find records by Location.
     *
     * @param  Location  $location
     * @return Workout|Collection|static[]|static|null
     */
    public function getByLocation(Location $location);

}
