<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @return bool
     */
    public function before($user)
    {
        $result = false;
        if ($user->level === User::LEVEL_ADMIN)
        {
            return true;
        }
        return $result;
    }

    /**
     * Determine whether the user can view the models user.
     *
     * @param User $currentUser
     * @param User $user
     * @return mixed
     */
    public function view(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }

    /**
     * Determine whether the user can update the models user.
     *
     * @param User $currentUser
     * @param User $user
     * @return mixed
     */
    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }

    /**
     * Determine whether the user can delete the models user.
     *
     * @param User $currentUser
     * @param User $user
     * @return mixed
     */
    public function delete(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }
}
