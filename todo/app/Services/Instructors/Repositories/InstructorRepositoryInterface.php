<?php
/**
 */

namespace App\Services\Instructors\Repositories;

use App\Models\Instructor;

interface InstructorRepositoryInterface
{
    public function find(int $id);

    public function search(array $filters = []);

    public function searchToArray(array $filters = []);

    public function createFromArray(array $data): Instructor;

    public function create(array $data): Instructor;

    public function updateFromArray(Instructor $instructor, array $data);

    public function delete(int $id);


}