<?php

namespace App\Policies;

use App\User;
use App\Models\Flow;
use Illuminate\Auth\Access\HandlesAuthorization;

class FlowPolicy
{
    use HandlesAuthorization;


//    public function userInThisGroup(User $user, $groupID)
//    {
//
//        if ($user->groups()->find($groupID) == 1) {
//            return TRUE;
//        } else {
//            return FALSE;
//        }
//
//    }


    public function isCustodianInThisGroup(User $user)
    {

        foreach ($user->roles as $role) {
            if ($role->slug == 'admin') {
                return TRUE;
            }
            if ($role->slug == 'custodian') {
                return TRUE;
            }
        }
        return false;

    }

    /**
     * Determine whether the user can view any flows.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the flow.
     *
     * @param  \App\User $user
     * @param  \App\Flow $flow
     * @return mixed
     */
    public function view(User $user, Flow $flow)
    {

    }

    /**
     * Determine whether the user can create flows.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the flow.
     *
     * @param  \App\User $user
     * @param  \App\Flow $flow
     * @return mixed
     */
    public function update(User $user, Flow $flow)
    {
        //
    }

    /**
     * Determine whether the user can delete the flow.
     *
     * @param  \App\User $user
     * @param  \App\Flow $flow
     * @return mixed
     */
    public function delete(User $user, Flow $flow)
    {
        //
    }

    /**
     * Determine whether the user can restore the flow.
     *
     * @param  \App\User $user
     * @param  \App\Flow $flow
     * @return mixed
     */
    public function restore(User $user, Flow $flow)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the flow.
     *
     * @param  \App\User $user
     * @param  \App\Flow $flow
     * @return mixed
     */
    public function forceDelete(User $user, Flow $flow)
    {
        //
    }
}
