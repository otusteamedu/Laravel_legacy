<?php

namespace App\Policies;

use App\Models\Mpoll;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MpollPolicy extends BasePolicy
{

    /**
     * Determine whether the user can view any mpolls.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user):bool
    {
        return ($user->level);
    }

    /**
     * Determine whether the user can view the mpoll.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Mpoll  $mpoll
     * @return mixed
     */
    public function view(User $user, Mpoll $mpoll)
    {
        return $user->isModerator();
    }

    /**
     * Determine whether the user can create mpolls.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isModerator();
    }

    /**
     * Determine whether the user can update the mpoll.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Mpoll  $mpoll
     * @return mixed
     */
    public function update(User $user, Mpoll $mpoll)
    {
        return $user->isModerator();
    }

    /**
     * Determine whether the user can delete the mpoll.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Mpoll  $mpoll
     * @return mixed
     */
    public function delete(User $user, Mpoll $mpoll)
    {
        //
    }

    /**
     * Determine whether the user can restore the mpoll.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Mpoll  $mpoll
     * @return mixed
     */
    public function restore(User $user, Mpoll $mpoll)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the mpoll.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Mpoll  $mpoll
     * @return mixed
     */
    public function forceDelete(User $user, Mpoll $mpoll)
    {
        return $user->isAdmin();
    }
}
