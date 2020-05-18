<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LangConstructorPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
         if($user->account->isAdmin()){
             return true;
         }

         return null;
    }


    /**
     * Determine whether the user can view any construction.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {

        return $user->account->isModerator();
    }

    /**
     * Determine whether the user can view the construction.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Construction  $construction
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->account->isModerator();
    }

    /**
     * Determine whether the user can create construction.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->account->isModerator();
    }

    /**
     * Determine whether the user can update the construction.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Construction  $construction
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->account->isModerator();
    }

    /**
     * Determine whether the user can delete the construction.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Construction  $construction
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->account->isModerator();
    }



}
