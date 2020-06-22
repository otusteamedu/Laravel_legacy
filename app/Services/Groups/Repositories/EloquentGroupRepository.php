<?php

namespace App\Services\Groups\Repositories;

use App\DTOs\GroupDTO;
use App\DTOs\GroupFilterDTO;
use App\Models\Group;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

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
     * @param int $perPage
     * @param GroupFilterDTO $DTO
     * @return LengthAwarePaginator
     */
    public function getGroupsListPaginate(int $perPage, GroupFilterDTO $DTO): LengthAwarePaginator
    {
        $columns = [
            'id',
            'number',
            'course_id',
        ];

        $builder = Group::select($columns);
        $builder = $this->filter($builder, $DTO);

        $builder->with([
                'course:id,number',
            ])
            ->orderBy('number', 'ASC');

        $paginator = $this->paginate($builder, $perPage);

        return $paginator;
    }

    /**
     * @param Builder $builder
     * @param GroupFilterDTO $DTO
     * @return Builder
     */
    private function filter(Builder $builder, GroupFilterDTO $DTO): Builder
    {
        $filters = $DTO->toArray();
        if ($groupNumber = $filters['group']) {
            $builder->number($groupNumber);
        }
        if ($teacher = $filters['teacher']) {
            $builder->teacherName($teacher);
        }
        if ($courseNumber = $filters['course']) {
            $builder->courseNumber($courseNumber);
        }

        return $builder;
    }

    private function paginate(Builder $builder, int $perPage): LengthAwarePaginator
    {
        return $builder->paginate($perPage);
    }
}
