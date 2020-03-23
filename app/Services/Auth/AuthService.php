<?php

namespace App\Services\Auth;


use App\Models\User;

class AuthService
{
    public function hasUserPermission(User $user, string $permission)
    {
        //return $user->roles->isRead
    }
}
