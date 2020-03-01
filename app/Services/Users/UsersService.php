<?php

namespace App\Services\Users;


use App\Models\User;
use App\Services\Users\Handlers\CreateUserHandler;
use App\Services\Users\Handlers\UpdateUserHandler;
use App\Services\Users\Handlers\DeleteUserHandler;
use App\Services\Users\Repositories\EloquentUserRepository;
use App\Services\Users\Repositories\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UsersService
{
    private $createUserHandler;
    private $updateUserHandler;
    private $deleteUserHandler;
    private $userRepository;

    public function __construct(
        CreateUserHandler $createUserHandler,
        UpdateUserHandler $updateUserHandler,
        DeleteUserHandler $deleteUserHandler,
        EloquentUserRepository $userRepository //UserRepositoryInterface $userRepository @ToDo: сделать красиво, как в занятие по DI
    )
    {
        $this->createUserHandler = $createUserHandler; // @ToDo: уточнить, нормальная ли это практика, создавать на каждоей действие отдельный хендлер или лучше все размещать в одном
        $this->updateUserHandler = $updateUserHandler;
        $this->deleteUserHandler = $deleteUserHandler;
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
     * @param User $user
     */
    public function deleteUser(User $user) {
        return $this->deleteUserHandler->handle($user);
    }
}
