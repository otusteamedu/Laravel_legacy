<?php

namespace App\Http\Controllers\Cms;

use App\Models\User\User;

trait CurrentUser
{
    /**
     * @return User|null
     */
    protected function getCurrentUser(): ?User
    {
        return \Auth::user();
    }
}