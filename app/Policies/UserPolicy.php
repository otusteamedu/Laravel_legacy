<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $currentUser, User $user)
    {
        return $user->id === $currentUser->id;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  User  $currentUser
     * @param  User  $user
     * @return mixed
     */
    public function view(User $currentUser, User $user)
    {
        return $user->id === $currentUser->id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $currentUser, User $user)
    {
        return $user->id === $currentUser->id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function update(User $currentUser, User $user)
    {
        return $user->id === $currentUser->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param  User  $model
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->isRoot();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function restore(User $currentUser, User $user)
    {
        return $user->id === $currentUser->id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function forceDelete(User $currentUser, User $user)
    {
        return $user->id === $currentUser->id;
    }
}
