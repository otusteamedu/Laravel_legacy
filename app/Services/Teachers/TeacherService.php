<?php

namespace App\Services\Teachers;

use App\DTOs\TeacherFilterDTO;
use App\Models\User;
use App\Services\Helpers\Settings;
use App\Services\Teachers\Repositories\TeacherRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class TeacherService
{
    /** @var  TeacherRepositoryInterface */
    protected $repository;

    /**
     * GroupService constructor.
     * @param TeacherRepositoryInterface $repository
     */
    public function __construct(TeacherRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Список студентов с пагинацией
     * @param TeacherFilterDTO $DTO
     * @return LengthAwarePaginator
     */
    public function paginate(TeacherFilterDTO $DTO): LengthAwarePaginator
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
            __('users.full_name'),
            __('scheduler.email'),
            __('scheduler.subjects'),
            __('scheduler.teaching_load'),
        ];
    }

    public function syncWithSubjects(User $user, Collection $subjectIdDTOCollection): User
    {
        return $this->repository->syncWithSubjects($user, $subjectIdDTOCollection);
    }

    /**
     * Получить список id предметов преподавателя
     * @param User $user
     * @return array
     */
    public function getTeacherSubjectsId(User $user): array
    {
        return $this->repository->getTeacherSubjectsId($user);
    }
}
