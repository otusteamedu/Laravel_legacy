<?php
namespace Tests\Generators;

use App\Models\User;
use App\Models\UserGroup;
use App\Services\UserGroupsService;

/**
 * Class UserGenerator
 * @package Tests\Generators
 */
class UserGenerator
{
    /**
     * @var UserGroupsService
     */
    private $userGroupsService;

    /**
     * UsersTableSeeder constructor.
     * @param UserGroupsService $userGroupsService
     */
    public function __construct(UserGroupsService $userGroupsService)
    {
        $this->userGroupsService = $userGroupsService;
    }

    /**
     * @param string $groupName
     * @return User|mixed
     */
    public function createUser(string $groupName)
    {
        $user = factory(User::class)->create(['group_id' => $this->userGroupsService->getGroupIdByName($groupName)]);

        return $user;
    }

    /**
     * @param array $params
     * @return User|mixed
     */
    public function createUserByParams(array $params)
    {
        $user = factory(User::class)->create($params);

        return $user;
    }
}
