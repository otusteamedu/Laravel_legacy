<?php

namespace App\Services;

use App\Models\UserGroup;
use App\Services\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Mail;

class UsersService
{
    private $userRepository;
    private $userGroupsService;

    public function __construct(UserRepository $userRepository, UserGroupsService $userGroupsService)
    {
        $this->userRepository = $userRepository;
        $this->userGroupsService = $userGroupsService;
    }


    /**
     * @param array|null $options
     * @return User[]|Collection
     */
    public function all(array $options = null)
    {
        return $this->userRepository->getAll($options);
    }

    /**
     * @param array|null $options
     * @return LengthAwarePaginator
     */
    public function allPaginated(array $options = null)
    {
        return $this->userRepository->paginated($options);
    }

    /**
     * @param array $data
     * @return User
     */
    public function createUser(array $data)
    {
        return $this->userRepository->createFromArray($data);
    }

    /**
     * @param User $user
     * @param array $data
     * @return User
     */
    public function updateUser(User $user, array $data)
    {
        return $this->userRepository->updateFromArray($user, $data);
    }

    /**
     * @param User $user
     * @param array|null $options
     * @return bool|null
     * @throws \Exception
     */
    public function deleteUser(User $user, array $options = null)
    {
        return $this->userRepository->delete($user);
    }

    /**
     * @param string $name
     * @return User[]|Collection|null
     */
    public function getUsersByGroupName(string $name)
    {
        $groupId = $this->userGroupsService->getGroupIdByName($name);
        $users = $groupId ? $this->userRepository->findBy(['group_id' => $groupId]) : null;

        return $users;

    }

    /**
     * @param array|User $users
     * @param array $options
     */
    public function notify($users, array $options)
    {
        /** @var User $user */
        foreach ($users as $user) {
            mail($user->email, $options['subject'], $options['message']);
        }
    }

}
