<?php

namespace App\Services\Students\Handlers;

use App\Models\Student;
use Exception;

class DeleteStudentHandler extends BaseHandler
{
    /**
     * @param Student $student
     * @return bool
     * @throws Exception
     */
    public function handle(Student $student): bool
    {
        return $this->repository->delete($student);
    }
}
