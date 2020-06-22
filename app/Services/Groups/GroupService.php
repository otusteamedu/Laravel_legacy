<?php

namespace App\Services\Groups;

use App\DTOs\GroupDTO;
use App\DTOs\GroupFilterDTO;
use App\Models\Group;
use App\Services\Groups\Handlers\CreateGroupHandler;
use App\Services\Groups\Handlers\DeleteGroupHandler;
use App\Services\Groups\Handlers\UpdateGroupHandler;
use App\Services\Groups\Repositories\GroupRepositoryInterface;
use App\Services\Helpers\Settings;
use Illuminate\Pagination\LengthAwarePaginator;

class GroupService
{
    /** @var  GroupRepositoryInterface */
    protected $repository;
    /** @var CreateGroupHandler */
    protected $createGroupHandler;
    /** @var UpdateGroupHandler */
    protected $updateGroupHandler;
    /** @var DeleteGroupHandler */
    protected $deleteGroupHandler;

    /**
     * GroupService constructor.
     * @param GroupRepositoryInterface $repository
     * @param CreateGroupHandler $createGroupHandler
     * @param UpdateGroupHandler $updateGroupHandler
     * @param DeleteGroupHandler $deleteGroupHandler
     */
    public function __construct(
        GroupRepositoryInterface $repository,
        CreateGroupHandler $createGroupHandler,
        UpdateGroupHandler $updateGroupHandler,
        DeleteGroupHandler $deleteGroupHandler
    ) {
        $this->repository = $repository;
        $this->createGroupHandler = $createGroupHandler;
        $this->updateGroupHandler = $updateGroupHandler;
        $this->deleteGroupHandler = $deleteGroupHandler;
    }

    /**
     * @param GroupFilterDTO $DTO
     * @return LengthAwarePaginator
     */
    public function paginate(GroupFilterDTO $DTO): LengthAwarePaginator
    {
        return $this->repository->getGroupsListPaginate(Settings::PER_PAGE, $DTO);
    }

    /**
     * @return array
     */
    public function getTableTitles(): array
    {
        return [__('scheduler.group'), __('scheduler.course')];
    }

    /**
     * @param GroupDTO $DTO
     * @return Group
     */
    public function store(GroupDTO $DTO): Group
    {
        return $this->createGroupHandler->handle($DTO);
    }

    /**
     * @param GroupDTO $DTO
     * @param Group $group
     * @return Group
     */
    public function update(GroupDTO $DTO, Group $group): Group
    {
        return $this->updateGroupHandler->handle($DTO, $group);
    }

    /**
     * @param Group $group
     * @return bool
     */
    public function delete(Group $group): bool
    {
        return $this->deleteGroupHandler->handle($group);
    }
}
