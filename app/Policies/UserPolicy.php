<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @return bool
     */
    public function before(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        };
    }

    /**
     * Determine whether the logged-in user can update given user.
     * @param \App\Models\User $authUser
     * @param \App\Models\User $user
     * @return mixed
     */
    public function update(User $authUser, User $user)
    {
        // по умолчанию, первый пользователь - authenticated user.
        $result = false;
        if (Auth::check()) {
            $result = $authUser->id === $user->id;
        }
        return $result;
    }
}
