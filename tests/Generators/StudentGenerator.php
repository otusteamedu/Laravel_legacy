<?php

/**
 * Created by PhpStorm.
 * User: Rom
 * Date: 01.05.2020
 * Time: 14:00
 */

namespace Tests\Generators;

use App\Models\Student;

class StudentGenerator
{


    public static function createStudent(array $data = [])
    {
        return factory(Student::class)->create($data);
    }


    public static function createStudentSpiderMan(array $data = []) {
        return self::createStudent(array_merge([
            'name' => 'SpiderMan',
        ], $data));
    }

}