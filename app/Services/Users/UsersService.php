<?php

namespace App\Services\Users;


use App\Models\User;
use App\Services\Users\Handlers\CreateUserHandler;
use App\Services\Users\Handlers\UpdateUserHandler;
use App\Services\Users\Repositories\EloquentUserRepository;
use App\Services\Users\Repositories\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UsersService
{
    private $createUserHandler;
    private $updateUserHandler;
    private $userRepository;

    public function __construct(
        CreateUserHandler $createUserHandler,
        UpdateUserHandler $updateUserHandler,
        EloquentUserRepository $userRepository //UserRepositoryInterface $userRepository @ToDo: сделать красиво, как в занятие по DI
    )
    {
        $this->createUserHandler = $createUserHandler;
        $this->updateUserHandler = $updateUserHandler;
        $this->userRepository = $userRepository;
    }

    /**
     * @param int $id
     * @return User|null
     */
    public function findUser(int $id)
    {
        return $this->userRepository->find($id);
    }

    /**
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function searchUsers(array $filters): LengthAwarePaginator
    {
        return $this->userRepository->search($filters);
    }

    /**
     * @param array $data
     * @return User
     */
    public function storeUser(array $data): User
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
        return $this->updateUserHandler->handle($user, $data);
    }

    /**
     * @param int $id
     */
    public function deleteUser(int $id) {

    }
}
