<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Http\Request;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models users.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        // Помни, что здесь $user === auth()->user();
        return auth()->user()->level === User::LEVEL_ADMIN;
    }

    /**
     * Determine whether the user can view the models user.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function view(User $currentUser, User $user)
    {
        //dd("view() id = ".$id);
        // $user === auth()->user()->id
        // Поэтому будет всегда возвращать значение true.
        // т.е. этот способ, как и в случае с Gates тоже не работает.

        //return auth()->user()->id === $user->id;
        return $currentUser->id === $user->id;
    }

    /**
     * Determine whether the user can create models users.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the models user.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
        //
    }

    /**
     * Determine whether the user can delete the models user.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        //
    }

    /**
     * Determine whether the user can restore the models user.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function restore(User $user)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the models user.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        //
    }
}
