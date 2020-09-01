<?php

namespace App\Policies;

use App\Models\Division;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DivisionPolicy
{
    use HandlesAuthorization;

    /**
     *
     * @param User $user
     * @return mixed
     */
    public function before($user){
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Division $division
     * @return mixed
     */
    public function view(User $user, Division $division)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Division $division
     * @return mixed
     */
    public function update(User $user, Division $division)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Division $division
     * @return mixed
     */
    public function delete(User $user, Division $division)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Division $division
     * @return mixed
     */
    public function restore(User $user, Division $division)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Division $division
     * @return mixed
     */
    public function forceDelete(User $user, Division $division)
    {
        return $user->isAdmin();
    }
}
