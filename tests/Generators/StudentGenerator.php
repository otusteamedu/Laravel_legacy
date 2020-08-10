<?php

namespace Tests\Generators;

use App\Models\Role;
use App\Models\Student;
use App\Models\User;

class StudentGenerator
{
    /**
     * @return Student
     */
    public static function generateStudent(): Student
    {
        return factory(Student::class)->create([
            'user_id' => factory(User::class)->create([
                'role_id' => Role::STUDENT,
            ]),
        ]);
    }
}
