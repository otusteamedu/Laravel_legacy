<?php

namespace Tests\Generators;

use App\Models\Role;
use App\Models\Student;
use App\Models\User;

/**
 * Class UserGenerator
 * @package Tests\Generators
 */
class UserGenerator
{
    /**
     * @return User
     */
    public static function generateMethodist(): User
    {
        return factory(User::class)->create([
            'role_id' => Role::METHODIST,
        ]);
    }

    /**
     * @return User
     */
    public static function generateStudent(): User
    {
        return factory(User::class)->create([
            'role_id' => Role::STUDENT,
        ]);
    }

    /**
     * @return User
     */
    public static function generateTeacher(): User
    {
        return factory(User::class)->create([
            'role_id' => Role::TEACHER,
        ]);
    }
}
