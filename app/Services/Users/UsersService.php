<?php
/**
 * Description of UsersService.php
 */

namespace App\Services\Users;
use App\Models\User as User;
use App\Services\Users\Handlers\CreateUserHandler;
use App\Services\Users\Handlers\UpdateUserHandler;

class UsersService
{
    private $createUserHandler;
    private $updateUserHandler;

    public function __construct(CreateUserHandler $createUserHandler, UpdateUserHandler $updateUserHandler)
    {
        $this->createUserHandler = $createUserHandler;
        $this->updateUserHandler = $updateUserHandler;
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

}
