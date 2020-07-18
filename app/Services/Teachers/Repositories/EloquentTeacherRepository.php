<?php

namespace App\Services\Teachers\Repositories;

use App\DTOs\IdDTO;
use App\DTOs\TeacherFilterDTO;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * Class EloquentTeacherRepository
 * @package App\Services\Teachers\Repositories
 */
class EloquentTeacherRepository implements TeacherRepositoryInterface
{
    /**
     * Список студентов с пагинацией
     * @param int $perPage
     * @param TeacherFilterDTO $DTO
     * @return LengthAwarePaginator
     */
    public function getListPaginate(int $perPage, TeacherFilterDTO $DTO): LengthAwarePaginator
    {
        $columns = [
            'id',
            'last_name',
            'name',
            'second_name',
            'email',
            'email',
        ];

        $builder = User::select($columns)->byRole(Role::TEACHER);
        $builder = $this->filter($builder, $DTO);
        $builder->with([
                'subjects:id,name',
                'educationPlans:id,hours,user_id',
            ])
            ->orderBy('last_name', 'ASC');

        $paginator = $this->paginate($builder, $perPage);

        return $paginator;
    }

    /**
     * @param Builder $builder
     * @param TeacherFilterDTO $DTO
     * @return Builder
     */
    private function filter(Builder $builder, TeacherFilterDTO $DTO): Builder
    {
        $filters = $DTO->toArray();
        if ($lastName = $filters[TeacherFilterDTO::LAST_NAME]) {
            $builder->lastName($lastName);
        }
        if ($email = $filters[TeacherFilterDTO::EMAIL]) {
            $builder->email($email);
        }
        if ($subjectId = $filters[TeacherFilterDTO::SUBJECT_ID]) {
            $builder->whereHas('subjects', function (Builder $builder) use ($subjectId): void {
                $builder->whereId($subjectId);
            });
        }

        return $builder;
    }

    /**
     * @param Builder $builder
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    private function paginate(Builder $builder, int $perPage): LengthAwarePaginator
    {
        return $builder->paginate($perPage);
    }

    /**
     * Обновить привязку студента к группам
     * @param User $user
     * @param Collection $idDTOCollection
     * @param bool $detaching
     * @return User
     */
    public function syncWithSubjects(User $user, Collection $idDTOCollection, bool $detaching = true): User
    {
        $ids = $idDTOCollection->map(function (IdDTO $idDTO): int {
            return $idDTO->toArray()[IdDTO::ID];
        });

        $user->subjects()->sync($ids, $detaching);

        return $user;
    }

    /**
     * Получить список id предметов преподавателя
     * @param User $user
     * @return array
     */
    public function getTeacherSubjectsId(User $user): array
    {
        return $user->subjects->pluck('id')->toArray();
    }

    /**
     * @param array $columns
     * @return Collection
     */
    public function getTeacherCollection(array $columns): Collection
    {
        return User::select($columns)
            ->byRole(Role::TEACHER)->get();
    }
}
