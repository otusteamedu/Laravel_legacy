<?php

namespace App\Services\Student\Repositories;

use App\Models\Student;

/**
 * Created by PhpStorm.
 * User: Rom
 * Date: 28.04.2020
 * Time: 11:22
 */
class StudentRepository
{

    public function all()
    {
        $student = new Student;
        return $student->all();
    }

    public function paginate(Int $count)
    {

        return Student::orderBy('id', 'desc')->paginate($count);
    }

    public function getById(int $id)
    {
        return Student::where('id', $id)->first();
    }


    public function createFromArray(array $data)
    {

//        $student = Student::create($data->except('user_id'));
//        if ($data->input('user_id')):
//            $student->users()->attach($data->input('user_id'));
//        endif;
//        return $student;
    }


    public function createFromObject($data)
    {

        $student = Student::create($data->except('user_id'));
        if ($data->input('user_id')):
            $student->users()->attach($data->input('user_id'));
        endif;
        return $student;
    }


}