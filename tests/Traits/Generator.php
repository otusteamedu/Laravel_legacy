<?php

namespace Tests\Traits;

use App\Models\Course;
use App\Models\Group;
use App\Models\Role;
use App\Models\Student;
use App\Models\User;

/**
 * Trait Generator
 * @package Tests\Traits
 */
trait Generator
{
    /**
     * @return User
     */
    public function generateMethodist(): User
    {
        return factory(User::class)->create([
            'role_id' => Role::METHODIST,
        ]);
    }

    /**
     * @return Student
     */
    public function generateStudent(): Student
    {
        return factory(Student::class)->create([
            'user_id' => factory(User::class)->create([
                'role_id' => Role::STUDENT,
            ]),
        ]);
    }

    /**
     * @return User
     */
    public function generateTeacher(): User
    {
        return factory(User::class)->create([
            'role_id' => Role::TEACHER,
        ]);
    }

    /**
     * @param $data
     * @return Group
     */
    public function generateGroup(array $data): Group
    {
        return factory(Group::class)->create([
            'course_id' => factory(Course::class)->create(),
            'education_year_id' => $data['education_year_id'],
        ]);
    }
}
