<?php

namespace App\Services\Cms\User;

use App\Models\User\Group;
use App\Repositories\User\Group\GroupRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
            Log::info(
                __('log.info.create.group'),
                [
                    'id' => $group->id,
                    'name' => $group->name,
                    'user' => Auth::user()->id,
                ]
            );
            $url = route('cms.groups.show', ['group' => $group->id]);
        } catch (\Throwable $exception) {
            Log::critical(
                __('log.critical.notCreate.group'),
                [
                    'exception' => $exception->getMessage(),
                    'data' => $data,
                    'user' => Auth::user()->id,
                ]
            );
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
            Log::info(
                __('log.info.update.group'),
                [
                    'id' => $group->id,
                    'name' => $group->name,
                    'user' => Auth::user()->id,
                ]
            );
            $url = route('cms.groups.show', ['group' => $group->id]);
        } catch (\Throwable $exception) {
            Log::critical(
                __('log.critical.notUpdate.group'),
                [
                    'exception' => $exception->getMessage(),
                    'id' => $group->id,
                    'data' => $data,
                    'user' => Auth::user()->id,
                ]
            );
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
            Log::info(
                __('log.info.destroy.group'),
                [
                    'id' => $group->id,
                    'name' => $group->name,
                    'user' => Auth::user()->id,
                ]
            );
            $url = route('cms.groups.index');
        } catch (\Throwable $exception) {
            Log::critical(
                __('log.critical.notDestroy.group'),
                [
                    'exception' => $exception->getMessage(),
                    'data' => $group->id,
                    'user' => Auth::user()->id,
                ]
            );
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
