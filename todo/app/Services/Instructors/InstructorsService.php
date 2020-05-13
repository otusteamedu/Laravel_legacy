<?php
/**
 * Description of InstructorsService.php
 *
 *
 */
namespace App\Services\Instructors;

use App\Models\Instructor;

use App\Services\Instructors\Repositories\InstructorRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class InstructorsService
{

    /** @var InstructorRepositoryInterface */
    private $instructorRepository;

    private $createInstructorHandler;

    public function __construct(

        InstructorRepositoryInterface $instructorRepository
    )
    {
        $this->instructorRepository = $instructorRepository;
    }

    /**
     * @param int $id
     * @return Instructor|null
     */
    public function findInstructor(int $id)
    {
        // return $this->instructorRepository->find($id);
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchInstructors()
    {
        return $this->instructorRepository->search();

    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchInstructorsToArray()
    {
        return $this->instructorRepository->searchToArray();

    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchInstructorPermissions(Instructor $instructor)
    {
        return $this->instructorRepository->permissions($instructor);

    }

    /**
     * @param array $data
     * @return Instructor
     */
    public function storeInstructor(array $data): Instructor
    {
        $instructor = $this->instructorRepository->create($data);
        return $instructor;
    }

    /**
     * @param Instructor $instructor
     * @param array $data
     * @return Instructor
     */
    public function updateInstructor(Instructor $instructor, array $data)
    {
        return $this->instructorRepository->updateFromArray($instructor, $data);
    }

    public function deleteInstructor(int $id)
    {
        return $this->instructorRepository->delete($id);
    }


}