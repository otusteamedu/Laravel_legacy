<?php

namespace App\Services\Students\Handlers;

use App\DTOs\StudentDTO;
use App\Models\Student;

/**
 * Class UpdateStudentHandler
 * @package App\Services\Students\Handlers
 */
class UpdateStudentHandler extends BaseHandler
{
    /**
     * @param StudentDTO $DTO
     * @param Student $student
     * @return Student
     */
    public function handle(StudentDTO $DTO, Student $student): Student
    {
        return $this->repository->update($DTO, $student);
    }
}
