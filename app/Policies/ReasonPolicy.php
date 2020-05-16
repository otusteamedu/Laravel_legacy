<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reason;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReasonPolicy
{
    use HandlesAuthorization;

    public function checkRole(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        } else if ($user->isKaznachey()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can view any reasons.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the reason.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Reason $reason
     * @return mixed
     */
    public function view(User $user, Reason $reason)
    {
        //
    }

    /**
     * Determine whether the user can create reasons.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $this->checkRole($user);
    }

    /**
     * Determine whether the user can update the reason.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Reason $reason
     * @return mixed
     */
    public function update(User $user, Reason $reason)
    {
//        return true;
        return $this->checkRole($user);
    }

    /**
     * Determine whether the user can delete the reason.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Reason $reason
     * @return mixed
     */
    public function delete(User $user, Reason $reason)
    {
        return $this->checkRole($user);
    }

    /**
     * Determine whether the user can restore the reason.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Reason $reason
     * @return mixed
     */
    public function restore(User $user, Reason $reason)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the reason.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Reason $reason
     * @return mixed
     */
    public function forceDelete(User $user, Reason $reason)
    {
        //
    }
}
