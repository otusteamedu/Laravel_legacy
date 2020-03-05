<?php

namespace App\Services\UserGroup;


use App\Models\UserGroup;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class UserGroupService
{
    /**
     * @var UserGroupRepositoryInterface
     */
    protected UserGroupRepositoryInterface $userGroupRepository;

    public function __construct(UserGroupRepositoryInterface $userGroupRepository)
    {
        $this->userGroupRepository = $userGroupRepository;
    }

    public function getList(): ?Collection
    {
        return Cache::rememberForever('user.group.list', function () {
            return $this->userGroupRepository->getList();
        });
    }

    /**
     * @param string $code
     * @return int|null
     */
    public function getIdByCode(string $code): ?int
    {
        return Cache::rememberForever("user.group.getIdByCode.$code", function () use ($code) {
            if (($groupList = $this->getList()) === null) {
                return null;
            }

            /** @var UserGroup $group */
            $group = $groupList->where('code', '=', $code)->first();

            if ($group === null) {
                return null;
            }

            return $group->id;
        });
    }

    /**
     * @param int $groupId
     * @return string|null
     */
    public function getCodeById(int $groupId): ?string
    {
        return Cache::rememberForever("user.group.getCodeById.$groupId", function () use ($groupId) {
            if (($groupList = $this->getList()) === null) {
                return null;
            }

            /** @var UserGroup $group */
            $group = $groupList->where('id', '=', $groupId)->first();

            if ($group === null) {
                return null;
            }

            return $group->code;
        });
    }
}
