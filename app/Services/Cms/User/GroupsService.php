<?php

namespace App\Services\Cms\User;

use App\Models\User\Group;
use App\Repositories\User\Group\GroupRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class GroupsService
 * @package App\Services\Cms\User
 */
class GroupsService
{
    /** @var GroupRepositoryInterface $groupRepository */
    protected $groupRepository;

    /**
     * GroupsService constructor.
     * @param GroupRepositoryInterface $groupRepository
     */
    public function __construct(GroupRepositoryInterface $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }


    /**
     * @return LengthAwarePaginator
     */
    public function paginationList(): LengthAwarePaginator
    {
        return $this->groupRepository->paginationList([
                    'order' => ['column' => 'id', 'order' => 'asc'],
                ]);
    }

    /**
     * @param array $data
     * @return string
     */
    public function store(array $data): string
    {
        try {
            $group = $this->groupRepository->createFromArray($data);
            $url = route('cms.groups.show', ['group' => $group->id]);
        } catch (\Throwable $exception) {
            $url = route('cms.groups.create');
        }
        return $url;
    }

    /**
     * @param Group $group
     * @param array $data
     * @return string
     */
    public function update(Group $group, array $data): string
    {
        try {
            $this->groupRepository->updateFromArray($group, $data);
            $url = route('cms.groups.show', ['group' => $group->id]);
        } catch (\Throwable $exception) {
            $url = route('cms.groups.edit', ['group' => $group->id]);
        }
        return $url;
    }

    /**
     * @param Group $group
     * @return string
     */
    public function destroy(Group $group): string
    {
        try {
            $this->groupRepository->delete($group);
            $url = route('cms.groups.index');
        } catch (\Throwable $exception) {
            $url = route('cms.groups.show', ['group' => $group->id]);
        }
        return $url;
    }

    /**
     * @return array
     */
    public function getArrayList(): array
    {
        return $this->groupRepository->arrayList([
                     'order' => ['column' => 'id', 'order' => 'asc'],
                 ]);
    }
}