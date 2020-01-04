<?php


namespace App\Services\Admin\Users;


use App\Models\User;
use App\Services\Admin\Users\Handlers\CreateUserHandler;
use App\Services\Admin\Users\Handlers\GetUserByIdHandler;
use App\Services\Admin\Users\Handlers\GetUsersListHandler;
use App\Services\Admin\Users\Handlers\UpdateUserHandler;

/**
 * Class UsersService
 * @package App\Services\Admin\Users
 */
class UsersService
{
    /**
     * @var GetUsersListHandler
     */
    private $getUsersListHandler;

    /**
     * @var GetUserByIdHandler
     */
    private $getUserById;

    /**
     * @var UpdateUserHandler
     */
    private $updateUserHandler;

    /**
     * @var CreateUserHandler
     */
    private $createUserHandler;

    /**
     * UsersService constructor.
     * @param GetUsersListHandler $getUsersListHandler
     * @param GetUserByIdHandler $getUserByIdHandler
     * @param UpdateUserHandler $updateUserHandler
     * @param CreateUserHandler $createUserHandler
     */
    public function __construct(
        GetUsersListHandler $getUsersListHandler,
        GetUserByIdHandler $getUserByIdHandler,
        UpdateUserHandler $updateUserHandler,
        CreateUserHandler $createUserHandler
    )
    {
        $this->updateUserHandler = $updateUserHandler;
        $this->getUsersListHandler = $getUsersListHandler;
        $this->getUserById = $getUserByIdHandler;
        $this->createUserHandler = $createUserHandler;
    }

    /**
     * @param User $user
     * @param array $data
     * @return bool
     */
    public function updateUserData(User $user, array $data)
    {
        return $this->updateUserHandler->handle($user, $data);
    }

    /**
     * @return string
     */
    public function getUsersList()
    {
        return $this->getUsersListHandler->handle();
    }


    /**
     * @param int $id
     * @return string
     */
    public function getUserById(int $id)
    {
        return $this->getUserById->handle($id);
    }


    /**
     * @param array $data
     * @return bool|int
     */
    public function createUser(array $data)
    {
        return $this->createUserHandler->handle($data);
    }
}
