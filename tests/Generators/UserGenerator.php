<?php


namespace Tests\Generators;



use App\Models\User;

class UserGenerator
{

    public static function createUser(array $data = [])
    {
        return factory(User::class)->create($data);
    }

}
