<?php

namespace App\Services\User\Repositories;

use App\Models\User;

/**
 * Created by PhpStorm.
 * User: Rom
 * Date: 28.04.2020
 * Time: 11:22
 */
class UserRepository
{

    public function all()
    {
        $user = new User;
        return $user->all();
    }


}