<?php

namespace App\Services\Users\Repositories;

use App\Models\User;

class EloquentUserRepository
{
    public function getAllUsers()
    {
        return User::pluck('name', 'id');
    }
}
