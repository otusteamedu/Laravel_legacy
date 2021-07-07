<?php

namespace Tests\Generators;


use App\User;

class UserGenerator
{
    public static function getAdminUser()
    {
        return User::find(1);
    }

    public static function createUser(array $data = [])
    {
        $id = factory(User::class)->create($data)->id;
        return User::find($id);
    }
}
