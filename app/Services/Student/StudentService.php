<?php

/**
 * Created by PhpStorm.
 * User: Rom
 * Date: 28.04.2020
 * Time: 9:33
 */
namespace App\Services\Student;

use App\Services\Student\Repositories\StudentRepository;
use App\Services\Student\Handlers\CreateStudentHandler;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class StudentService
{

    protected $studentRepository;

    public function __construct(
        StudentRepository $studentRepository,
        CreateStudentHandler $createStudentHandler
    )
    {
        $this->studentRepository = $studentRepository;
        $this->createStudentHandler = $createStudentHandler;
    }


    /**
     * получаем всех пользователей
     * @return Collection|static[]
     */
    public function all()
    {
        return $this->studentRepository->all();
    }

    public function paginate(Int $count = 0)
    {

        if ((int)$count == 0) {
            $count = 7;
        }
        return $this->studentRepository->paginate($count);
    }

    public function getById(Int $id = 0)
    {
        return $this->studentRepository->getById($id);
    }


    public function create($request)
    {
        return $this->createStudentHandler->handle($request);
    }

    public function store($data)
    {
        return $this->createStudentHandler->handle($data);
    }

    public function update($student, $data)
    {
        return $this->studentRepository->updateFromArray($student, $data);
    }
}