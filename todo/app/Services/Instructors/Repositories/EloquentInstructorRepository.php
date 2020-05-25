<?php
/**
 */

namespace App\Services\Instructors\Repositories;


use App\Models\Instructor;

class EloquentInstructorRepository implements InstructorRepositoryInterface
{

    public function find(int $id)
    {
        return Instructor::find($id);
    }

    public function search(array $filters = [])
    {
        return Instructor::paginate();

    }

    public function searchToArray(array $filters = [])
    {
        return Instructor::all();
    }

    public function createFromArray(array $data): Instructor
    {
        $instructor = new Instructor();
        $instructor = $instructor->create($data);
        return $instructor;
    }

    public function updateFromArray(Instructor $instructor, array $data)
    {
        $result = Instructor::where('name', $data['name'])->get();
        if ((count($result) > 1) || (count($result) == 1 && $result[0]->id != $instructor->id)) {

            return ['error' => 'Это имя уже успользуется'];
        }
        $instructor->update($data);
        return 1;
    }

    public function create(array $data): Instructor
    {
        return $this->createFromArray($data);
    }

    public function delete(int $id)
    {
        return Instructor::destroy($id);
    }

}