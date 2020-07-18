<?php

namespace App\Services\Students\Handlers;

use App\DTOs\StudentDTO;
use App\Models\Student;
use App\Services\Students\Exceptions\CreateStudentException;

/**
 * Class CreateStudentHandler
 * @package App\Services\Students\Handlers
 */
class CreateStudentHandler extends BaseHandler
{
    /**
     * @param StudentDTO $DTO
     * @return Student
     */
    public function handle(StudentDTO $DTO): Student
    {
        $student = $this->repository->store($DTO);

        if (!$student) {
            throw new CreateStudentException();
        }

        return $student;
    }
}
