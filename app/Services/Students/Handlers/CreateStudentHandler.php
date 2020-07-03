<?php

namespace App\Services\Students\Handlers;

use App\DTOs\IdDTO;
use App\DTOs\StudentDTO;
use App\Http\Controllers\Students\Requests\StudentRequest;
use App\Models\Student;
use App\Services\Students\Exceptions\CreateStudentException;

class CreateStudentHandler extends BaseHandler
{
    /**
     * @param StudentRequest $request
     * @param IdDTO $userIdDTO
     * @return Student
     */
    public function handle(StudentRequest $request, IdDTO $userIdDTO): Student
    {
        $DTO = StudentDTO::fromArray(array_merge(
            $request->getFormData(),
            [StudentDTO::USER_ID => $userIdDTO->toArray()[IdDTO::ID]]
        ));


        $student = $this->repository->store($DTO);

        if (!$student) {
            throw new CreateStudentException();
        }

        return $student;
    }
}
