<?php


namespace App\Services\Users;

use App\Models\User;
use App\Services\Users\Handlers\CreateUserHandler;
use App\Services\Users\Repositories\UserRepositoryInterface;


class UsersService
{
    private $userRepository;
    private $createUserHandler;

    public function __construct(
        CreateUserHandler $createUserHandler,
        UserRepositoryInterface $userRepository
    )
    {
        $this->createUserHandler = $createUserHandler;
        $this->userRepository = $userRepository;
    }

    /**
     * @param array $data
     * @return User
     */
    public function storeUser(array $data): User
    {
        return $this->createUserHandler->handle($data);
    }

}
