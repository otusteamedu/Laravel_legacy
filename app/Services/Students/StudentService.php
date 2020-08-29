<?php

namespace App\Services\Students;

use App\DTOs\StudentDTO;
use App\DTOs\StudentFilterDTO;
use App\Models\Student;
use App\Services\Helpers\Settings;
use App\Services\Interfaces\CacheService;
use App\Services\Students\Handlers\CreateStudentHandler;
use App\Services\Students\Handlers\DeleteStudentHandler;
use App\Services\Students\Handlers\UpdateStudentHandler;
use App\Services\Students\Repositories\StudentRepositoryInterface;
use App\Services\Traits\CacheClearable;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * Class StudentService
 * @package App\Services\Students
 */
class StudentService implements CacheService
{
    use CacheClearable;

    const CACHE_TAG = 'STUDENT';

    /** @var  StudentRepositoryInterface */
    protected $repository;
    /** @var CreateStudentHandler */
    protected $createStudentHandler;
    /** @var UpdateStudentHandler */
    protected $updateStudentHandler;
    /** @var DeleteStudentHandler */
    protected $deleteStudentHandler;

    /**
     * GroupService constructor.
     * @param StudentRepositoryInterface $repository
     * @param CreateStudentHandler $createStudentHandler
     * @param UpdateStudentHandler $updateStudentHandler
     * @param DeleteStudentHandler $deleteStudentHandler
     */
    public function __construct(
        StudentRepositoryInterface $repository,
        CreateStudentHandler $createStudentHandler,
        UpdateStudentHandler $updateStudentHandler,
        DeleteStudentHandler $deleteStudentHandler
    ) {
        $this->repository = $repository;
        $this->createStudentHandler = $createStudentHandler;
        $this->updateStudentHandler = $updateStudentHandler;
        $this->deleteStudentHandler = $deleteStudentHandler;
    }

    public function cacheWarm(): void
    {
        $this->getTableTitles();

        $this->repository->getStudentsCollection(['id'])->each(function (Student $student) {
            $this->getStudentGroupsId($student);
        });
    }

    /**
     * Список студентов с пагинацией
     * @param StudentFilterDTO $DTO
     * @return LengthAwarePaginator
     */
    public function paginate(StudentFilterDTO $DTO): LengthAwarePaginator
    {
        return $this->repository->getListPaginate(Settings::PER_PAGE, $DTO);
    }

    /**
     * Названия колонок для списка студентов
     * @return array
     */
    public function getTableTitles(): array
    {
        return [
            __('scheduler.full_name'),
            __('scheduler.student_id'),
            __('scheduler.group'),
            __('scheduler.course'),
            ];
    }

    /**
     * @param StudentDTO $studentDTO
     * @param Collection $groupIdDTOCollection
     * @return Student
     */
    public function store(StudentDTO $studentDTO, Collection $groupIdDTOCollection): Student
    {
        $student = $this->createStudentHandler->handle($studentDTO);
        $student = $this->repository->syncWithGroups($student, $groupIdDTOCollection);

        return $student;
    }

    /**
     * @param StudentDTO $DTO
     * @param Student $student
     * @param Collection $groupIdDTOCollection
     * @return Student
     */
    public function update(StudentDTO $DTO, Student $student, Collection $groupIdDTOCollection): Student
    {
        $student = $this->updateStudentHandler->handle($DTO, $student);
        $student = $this->repository->syncWithGroups($student, $groupIdDTOCollection);

        return $student;
    }

    /**
     * @param Student $student
     * @return bool
     * @throws Exception
     */
    public function delete(Student $student): bool
    {
        return $this->deleteStudentHandler->handle($student);
    }

    /**
     * Получить список id групп студента
     * @param Student $student
     * @return array
     */
    public function getStudentGroupsId(Student $student): array
    {
        return $this->repository->getStudentGroupsId($student);
    }

    /**
     * Получить список групп студента id => number
     * @param Student $student
     * @return array
     */
    public function getStudentGroupsList(Student $student): array
    {
        return $this->repository->getStudentGroupsList($student);
    }

    /**
     * @param int $id
     * @return Student|null
     */
    public function getStudentByUserId(int $id): ?Student
    {
        return $this->repository->getStudentByUserId($id);
    }
}
