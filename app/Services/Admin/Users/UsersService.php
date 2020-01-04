<?php


namespace App\Services\Admin\Users;


use App\Models\User;
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
     * UsersService constructor.
     * @param GetUsersListHandler $getUsersListHandler
     * @param GetUserByIdHandler $getUserByIdHandler
     * @param UpdateUserHandler $updateUserHandler
     */
    public function __construct(
        GetUsersListHandler $getUsersListHandler,
        GetUserByIdHandler $getUserByIdHandler,
        UpdateUserHandler $updateUserHandler
    )
    {
        $this->updateUserHandler = $updateUserHandler;
        $this->getUsersListHandler = $getUsersListHandler;
        $this->getUserById = $getUserByIdHandler;
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
}
