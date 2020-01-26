<?php
/**
 * Description of UsersService.php
 */

namespace App\Services\Users;
use App\Models\User as User;
use App\Services\Users\Handlers\CreateUserHandler;
use App\Services\Users\Handlers\UpdateUserHandler;
use App\Services\Users\Handlers\UpdateProfileHandler;

class UsersService
{
    private $createUserHandler;
    private $updateUserHandler;
    private $updateProfileHandler;

    public function __construct(CreateUserHandler $createUserHandler, UpdateUserHandler $updateUserHandler, UpdateProfileHandler $updateProfileHandler)
    {
        $this->createUserHandler = $createUserHandler;
        $this->updateUserHandler = $updateUserHandler;
        $this->updateProfileHandler = $updateProfileHandler;
    }
    /**
     * @param array $data
     * @return User
     */
    public function createUser(array $data): User
    {
        return $this->createUserHandler->handle($data);
    }

    /**
     * @param User $user
     * @param array $data
     * @return User
     */
    public function updateUser(User $user, array $data): User
    {
        return $this->updateUserHandler->handle($user,$data);
    }

    /**
     * @param User $user
     * @param array $data
     * @return User
     */
    public function updateProfile(User $user, array $data): User
    {
        return $this->updateProfileHandler->handle($user,$data);
    }

}
