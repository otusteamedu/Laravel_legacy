<?php


namespace App\Services\Admin\Users;


use App\Services\Admin\Users\Handlers\GetUserByIdHandler;
use App\Services\Admin\Users\Handlers\GetUsersListHandler;

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
     * UsersService constructor.
     * @param GetUsersListHandler $getUsersListHandler
     * @param GetUserByIdHandler $getUserByIdHandler
     */
    public function __construct(
        GetUsersListHandler $getUsersListHandler,
        GetUserByIdHandler $getUserByIdHandler
    )
    {
        $this->getUsersListHandler = $getUsersListHandler;
        $this->getUserById = $getUserByIdHandler;
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
