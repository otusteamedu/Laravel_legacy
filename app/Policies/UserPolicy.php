<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Country;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view any countries.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isModerator();
    }

    /**
     * @param User $currentUser
     * @param User $user
     * @return bool
     */
    public function view(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * @param User $currentUser
     * @param User $user
     * @return bool
     */
    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }

    /**
     * @param User $currentUser
     * @param User $user
     * @return bool
     */
    public function delete(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }

    /**
     * @param User $currentUser
     * @param User $user
     * @return bool
     */
    public function restore(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }

    /**
     * @param User $currentUser
     * @param User $user
     * @return bool
     */
    public function forceDelete(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }

}
