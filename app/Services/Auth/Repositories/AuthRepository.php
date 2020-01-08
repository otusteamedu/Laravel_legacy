<?php


namespace App\Services\Auth\Repositories;


use App\Models\User;

/**
 * Class AuthRepository
 * @package App\Services\Auth\Repositories
 */
class AuthRepository
{
    /**
     * @param array $data
     * @return User
     */
    public function registerNewUser(array $data)
    {
        return User::create($data);
    }

    /**
     * @param $id integer
     * @return User
     */
    public function getUser($id)
    {
        return User::find($id);
    }
}
