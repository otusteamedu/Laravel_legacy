<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Workout;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class WorkoutPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any workouts.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin;
    }

    /**
     * Determine whether the user can view the workout.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Workout  $workout
     * @return mixed
     */
    public function view(User $user, Workout $workout)
    {
        return $user->id === $workout->user_id;
    }

    /**
     * Determine whether the user can create workouts.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return Auth::check();
    }

    /**
     * Determine whether the user can update the workout.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Workout  $workout
     * @return mixed
     */
    public function update(User $user, Workout $workout)
    {
        return $user->id === $workout->user_id;
    }

    /**
     * Determine whether the user can delete the workout.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Workout  $workout
     * @return mixed
     */
    public function delete(User $user, Workout $workout)
    {
        return $user->id === $workout->user_id;
    }

    /**
     * Determine whether the user can restore the workout.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Workout  $workout
     * @return mixed
     */
    public function restore(User $user, Workout $workout)
    {
        return $user->id === $workout->user_id;
    }

    /**
     * Determine whether the user can permanently delete the workout.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Workout  $workout
     * @return mixed
     */
    public function forceDelete(User $user, Workout $workout)
    {
        return $user->id === $workout->user_id;
    }
}
