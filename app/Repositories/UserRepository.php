<?php


namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    /**
     * Найтм пользователя по токену
     *
     * @param $token
     * @return mixed
     */
    public function getUserByToken($token)
    {
        return User::where('api_token', $token)->first();
    }
}