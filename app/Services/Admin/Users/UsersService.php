<?php


namespace App\Services\Admin\Users;


use App\Models\User;
use App\Services\Admin\Users\Handlers\CreateUserHandler;
use App\Services\Admin\Users\Handlers\UpdateUserHandler;
use App\Services\Admin\Users\Repositories\UsersRepository;

/**
 * Class UsersService
 * @package App\Services\Admin\Users
 */
class UsersService
{
    /**
     * @var UsersRepository
     */
    private $usersRepository;

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
     * @param UsersRepository $usersRepository
     * @param UpdateUserHandler $updateUserHandler
     * @param CreateUserHandler $createUserHandler
     */
    public function __construct(
        UsersRepository $usersRepository,
        UpdateUserHandler $updateUserHandler,
        CreateUserHandler $createUserHandler
    )
    {
        $this->usersRepository = $usersRepository;
        $this->updateUserHandler = $updateUserHandler;
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
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getUsersList()
    {
        return $this->usersRepository->getList();
    }


    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public function getUserById(int $id)
    {
        return $this->usersRepository->getUserById($id);
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
