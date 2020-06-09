<?php

namespace App\Policies;

use App\Models\Advert;
use App\Models\Message;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HomePolicy
{
    use HandlesAuthorization;
    /**
     * @param  \App\Models\User  $user
     * @var $advert
     * @return mixed
     */

    public function advertUpdate(User $user, Advert $advert)
    {
        if($user->isAdmin()){
            return true;
        } elseif($user->id == $advert->user_id)  {
            return true;
        }
        return false;
    }

    /**
     * @param  \App\Models\User  $user
     * @var $user_id
     * @return mixed
     */
    public function messageUpdate(User $user, Message $message)
    {
        if($user->isAdmin()){
            return true;
        } elseif($user->id == $message->user_id)  {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Advert  $advert
     * @return mixed
     */
    public function view(User $user, Advert $advert)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Advert  $advert
     * @return mixed
     */
    public function update(User $user, Advert $advert)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Advert  $advert
     * @return mixed
     */
    public function delete(User $user, Advert $advert)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Advert  $advert
     * @return mixed
     */
    public function restore(User $user, Advert $advert)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Advert  $advert
     * @return mixed
     */
    public function forceDelete(User $user, Advert $advert)
    {
        //
    }
}
