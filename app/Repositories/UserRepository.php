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

    /**
     * User create
     *
     * @param $data
     * @return mixed
     */
    public function register($data)
    {
        return User::create($data);
    }

    /**
     * User password update
     *
     * @param $user
     * @param $password
     * @return mixed
     */
    public function passwordUpdate($user, $password)
    {
        return $user->update([
            'password' => $password
        ]);
    }
}