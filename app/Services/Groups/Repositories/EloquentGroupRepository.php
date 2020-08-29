<?php

namespace App\Services\Groups\Repositories;

use App\DTOs\GroupDTO;
use App\DTOs\GroupFilterDTO;
use App\Models\Group;
use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

/**
 * Class EloquentGroupRepository
 * @package App\Services\Groups\Repositories
 */
class EloquentGroupRepository implements GroupRepositoryInterface
{
    /**
     * @param Group $group
     * @return bool
     * @throws \Exception
     */
    public function delete(Group $group): bool
    {
        return $group->delete();
    }

    /**
     * @param GroupDTO $groupDTO
     * @param Group $group
     * @return Group
     */
    public function update(GroupDTO $groupDTO, Group $group): Group
    {
        $group->update($groupDTO->toArray());
        return $group;
    }

    /**
     * @param GroupDTO $DTO
     * @return Group
     */
    public function store(GroupDTO $DTO): Group
    {
        return Group::firstOrCreate($DTO->toArray());
    }

    /**
     * Список групп с пагинацией
     * @param int $perPage
     * @param GroupFilterDTO $DTO
     * @return LengthAwarePaginator
     */
    public function getGroupsListPaginate(int $perPage, GroupFilterDTO $DTO): LengthAwarePaginator
    {
        $builder = $this->selectRequiredColumns(Group::query())
            ->with([
                'course:id,number',
            ]);
            $builder = $this->filter($builder, $DTO);
            $builder->orderBy('number', 'ASC');

        $paginator = $this->paginate($builder, $perPage);

        return $paginator;
    }

    /**
     * Фильтрует список групп
     * @param Builder $builder
     * @param GroupFilterDTO $DTO
     * @return Builder
     */
    private function filter(Builder $builder, GroupFilterDTO $DTO): Builder
    {
        $filters = $DTO->toArray();
        if ($groupNumber = $filters[GroupFilterDTO::GROUP]) {
            $builder->number($groupNumber);
        }
        if ($teacher = $filters[GroupFilterDTO::TEACHER]) {
            $builder->teacherName($teacher);
        }
        if ($courseNumber = $filters[GroupFilterDTO::COURSE]) {
            $builder->courseNumber($courseNumber);
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
     * @param Builder $builder
     * @param array|null $columns
     * @return Builder
     */
    private function selectRequiredColumns(Builder $builder, array $columns = null): Builder
    {
        if (!$columns) {
            $columns = [
                'id',
                'number',
                'course_id',
            ];
        }

        return $builder->select($columns);
    }

    /**
     * @param Role|null $userRole
     * @return Collection
     */
    public function selectList(Role $userRole = null): Collection
    {
        $groups = Group::query()
            ->when(($userRole && ($userRole->name === 'teacher')), function (Builder $builder) {
                $builder->whereHas('teachers', function (Builder $builder): void {
                    $builder->where('groups.id', Auth::id());
                });
            })
            ->pluck('number', 'id');

        return $groups;
    }

    /**
     * Возвращает коллекцию групп с курсами
     * @return Collection
     */
    public function selectListWithCourse(): Collection
    {
        $groups = $this->selectRequiredColumns(Group::query())
            ->with([
                'course:id,number',
            ])
            ->orderBy('number', 'ASC')
            ->get();

        return $groups->pluck('groupCourse', 'id');
    }

    /**
     * @param int $number
     * @return Group|null
     */
    public function getByNumber(int $number): ?Group
    {
        return Group::whereNumber($number)->first();
    }
}
