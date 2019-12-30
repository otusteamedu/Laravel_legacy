<?php


namespace App\Services\Admin\Users;


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
     * UsersService constructor.
     * @param GetUsersListHandler $getUsersListHandler
     */
    public function __construct(
        GetUsersListHandler $getUsersListHandler
    )
    {
        $this->getUsersListHandler = $getUsersListHandler;
    }


    /**
     * @return string
     */
    public function getUsersList()
    {
        return $this->getUsersListHandler->handle();
    }
}
