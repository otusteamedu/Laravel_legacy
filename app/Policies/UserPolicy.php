<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * @param  User  $user
     *
     * @return bool
     */
    public function before(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * @return bool
     */
    public function viewAny()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function view()
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  User  $user
     *
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  User  $user
     * @param  User  $profile
     *
     * @return mixed
     */
    public function update(User $user, User $profile)
    {
        if ($user->id === $profile->id) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param  User  $profile
     *
     * @return mixed
     */
    public function delete(User $user, User $profile)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  User  $user
     * @param  User  $profile
     *
     * @return mixed
     */
    public function restore(User $user, User $profile)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  User  $user
     * @param  User  $profile
     *
     * @return mixed
     */
    public function forceDelete(User $user, User $profile)
    {
        //
    }
}
