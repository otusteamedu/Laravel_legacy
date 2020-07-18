<?php

namespace App\Services\Teachers;

use App\DTOs\TeacherFilterDTO;
use App\Models\User;
use App\Services\Helpers\Settings;
use App\Services\Interfaces\CacheService;
use App\Services\Teachers\Repositories\TeacherRepositoryInterface;
use App\Services\Traits\CacheClearable;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * Class TeacherService
 * @package App\Services\Teachers
 */
class TeacherService implements CacheService
{
    use CacheClearable;

    const CACHE_TAG = 'USER';

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

    public function cacheWarm(): void
    {
        $this->getTableTitles();

        $this->repository->getTeacherCollection(['id'])->each(function (User $user) {
            $this->getTeacherSubjectsId($user);
        });
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
