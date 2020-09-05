<?php

namespace App\Services;

use App\Services\Repositories\UserGroupCacheRepository;
use App\Services\Repositories\UserGroupRepository;
use App\Models\UserGroup;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class UserGroupsService
 * @package App\Services
 */
class UserGroupsService
{
    /**
     * @var UserGroupRepository
     */
    private $userGroupRepository;

    /**
     * @var UserGroupCacheRepository
     */
    private $userGroupCacheRepository;

    /**
     * UserGroupsService constructor.
     * @param UserGroupRepository $userGroupRepository
     * @param UserGroupCacheRepository $userGroupCacheRepository
     */
    public function __construct(UserGroupRepository $userGroupRepository, UserGroupCacheRepository $userGroupCacheRepository)
    {
        $this->userGroupRepository = $userGroupRepository;
        $this->userGroupCacheRepository = $userGroupCacheRepository;
    }

    /**
     * @param array|null $options
     * @return UserGroup[]|Collection
     */
    public function all(array $options = null)
    {
        return $this->userGroupRepository->getAll($options);
    }

    /**
     * @param array|null $options
     * @return LengthAwarePaginator
     */
    public function allPaginated(array $options = null)
    {
        return $this->userGroupRepository->paginated($options);
    }

    /**
     * @param array|null $options
     * @return array
     */
    public function getUserGroupsList(array $options = null)
    {
        return $this->userGroupRepository->getList($options);
    }

    /**
     * @param array|null $options
     * @return int
     */
    public function getGroupIdByName(string $name)
    {
        return $this->userGroupRepository->getIdByName($name);
    }

    /**
     * @param array $data
     * @return UserGroup
     */
    public function createUserGroup(array $data)
    {
        return $this->userGroupRepository->createFromArray($data);
    }

    /**
     * @param UserGroup $userGroup
     * @param array $data
     * @return UserGroup
     */
    public function updateUserGroup(UserGroup $userGroup, array $data)
    {
        return $this->userGroupRepository->updateFromArray($userGroup, $data);
    }

    /**
     * @param UserGroup $userGroup
     * @param array|null $options
     * @return bool|null
     * @throws \Exception
     */
    public function deleteUserGroup(UserGroup $userGroup, array $options = null)
    {
        return $this->userGroupRepository->delete($userGroup);
    }

    /**
     * Очистка кэша
     */
    public function clearCache()
    {
        $this->userGroupCacheRepository->clear();

    }

}
