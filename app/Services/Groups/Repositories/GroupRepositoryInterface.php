<?php

namespace App\Services\Groups\Repositories;

use App\DTOs\GroupDTO;
use App\DTOs\GroupFilterDTO;
use App\Models\Group;
use Illuminate\Pagination\LengthAwarePaginator;

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
}
