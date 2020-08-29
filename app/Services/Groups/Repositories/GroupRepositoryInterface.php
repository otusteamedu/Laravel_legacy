<?php

namespace App\Services\Groups\Repositories;

use App\DTOs\GroupDTO;
use App\DTOs\GroupFilterDTO;
use App\Models\Group;
use App\Models\Role;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * Interface GroupRepositoryInterface
 * @package App\Services\Groups\Repositories
 */
interface GroupRepositoryInterface
{
    /**
     * @param Group $group
     * @return bool
     */
    public function delete(Group $group): bool;

    /**
     * @param GroupDTO $groupDTO
     * @param Group $group
     * @return Group
     */
    public function update(GroupDTO $groupDTO, Group $group): Group;

    /**
     * @param GroupDTO $DTO
     * @return Group
     */
    public function store(GroupDTO $DTO): Group;

    /**
     * @param int $perPage
     * @param GroupFilterDTO $DTO
     * @return LengthAwarePaginator
     */
    public function getGroupsListPaginate(int $perPage, GroupFilterDTO $DTO): LengthAwarePaginator;

    /**
     * @param Role|null $userRole
     * @return Collection
     */
    public function selectList(Role $userRole = null): Collection;

    /**
     * @return Collection
     */
    public function selectListWithCourse(): Collection;

    /**
     * @param int $number
     * @return Group|null
     */
    public function getByNumber(int $number): ?Group;
}
