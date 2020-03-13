<?php


namespace App\Services\API\User\Repositories;


use App\Models\Role;
use App\Models\User;

class EloquentUserRepository
{
    public function getUser($id)
    {
        $result = User::findOrFail($id);
        return $result;
    }
}
