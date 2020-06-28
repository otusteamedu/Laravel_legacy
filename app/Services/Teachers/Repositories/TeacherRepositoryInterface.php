<?php

namespace App\Services\Teachers\Repositories;

use App\DTOs\TeacherFilterDTO;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface TeacherRepositoryInterface
{
    /**
     * Список студентов с пагинацией
     * @param int $perPage
     * @param TeacherFilterDTO $DTO
     * @return LengthAwarePaginator
     */
    public function getListPaginate(int $perPage, TeacherFilterDTO $DTO): LengthAwarePaginator;

    /**
     * Обновить привязку студента к группам
     * @param User $user
     * @param Collection $idDTOCollection
     * @param bool $detaching
     * @return User
     */
    public function syncWithSubjects(User $user, Collection $idDTOCollection, bool $detaching = true): User;

    /**
     * Получить список id предметов преподавателя
     * @param User $user
     * @return array
     */
    public function getTeacherSubjectsId(User $user): array;
}
