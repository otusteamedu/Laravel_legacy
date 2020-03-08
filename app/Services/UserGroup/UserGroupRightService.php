<?php


namespace App\Services\UserGroup;


use App\Models\UserGroupRight;
use Illuminate\Support\Collection;

class UserGroupRightService
{
    public const CACHE_USER_GROUP_CACHE_LIST = 'user.group.right.list';

    protected UserGroupRightRepositoryInterface $userGroupRightRepository;

    public function __construct(UserGroupRightRepositoryInterface $userGroupRightRepository)
    {
        $this->userGroupRightRepository = $userGroupRightRepository;
    }

    public function getList(): ?Collection
    {
        // TODO return cache - has a problems
//        return \Cache::rememberForever(self::CACHE_USER_GROUP_CACHE_LIST, function () {
//            $this->userGroupRightRepository->getList();
//        });

        return $this->userGroupRightRepository->getList();
    }

    public function getByCode(string $code): ?UserGroupRight
    {
        return $this->userGroupRightRepository->getByCode($code);
    }

    public function hasRight(int $groupId, string $code): bool
    {
        if (($list = $this->getList()) === null) {
            return false;
        }

        $first = $list->first(static function ($right) use ($groupId, $code) {
            /** @var UserGroupRight $right */
            return $right->code === $code && $right->group_id === $groupId;
        });

        return $first !== null;
    }

    /**
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function clearCache(): void
    {
        \Cache::delete(self::CACHE_USER_GROUP_CACHE_LIST);
    }
}
