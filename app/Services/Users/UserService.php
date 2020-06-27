<?php

namespace App\Services\Users;

use App\DTOs\UserDTO;
use App\Models\Role;
use App\Models\User;
use App\Services\Users\Handlers\CreateUserHandler;
use App\Services\Users\Handlers\DeleteUserHandler;
use App\Services\Users\Handlers\UpdateUserHandler;
use App\Services\Users\Repositories\UserRepositoryInterface;
use Exception;

class UserService
{
    /** @var  UserRepositoryInterface */
    protected $repository;
    /** @var CreateUserHandler */
    protected $createUserHandler;
    /** @var UpdateUserHandler */
    protected $updateUserHandler;
    /** @var DeleteUserHandler */
    protected $deleteUserHandler;

    /**
     * GroupService constructor.
     * @param UserRepositoryInterface $repository
     * @param CreateUserHandler $createUserHandler
     * @param UpdateUserHandler $updateUserHandler
     * @param DeleteUserHandler $deleteUserHandler
     */
    public function __construct(
        UserRepositoryInterface $repository,
        CreateUserHandler $createUserHandler,
        UpdateUserHandler $updateUserHandler,
        DeleteUserHandler $deleteUserHandler
    ) {
        $this->repository = $repository;
        $this->createUserHandler = $createUserHandler;
        $this->updateUserHandler = $updateUserHandler;
        $this->deleteUserHandler = $deleteUserHandler;
    }

    /**
     * @param UserDTO $DTO
     * @return User
     */
    public function store(UserDTO $DTO): User
    {
        return $this->createUserHandler->handle($DTO);
    }

    /**
     * @param UserDTO $DTO
     * @param User $user
     * @return User
     */
    public function update(UserDTO $DTO, User $user): User
    {
        return $this->updateUserHandler->handle($DTO, $user);
    }

    /**
     * @param User $user
     * @return bool
     * @throws Exception
     */
    public function delete(User $user): bool
    {
        return $this->deleteUserHandler->handle($user);
    }

    /**
     * @param array $data
     * @return UserDTO
     */
    public function prepareUserDTOForStudent(array $data): UserDTO
    {
        return UserDTO::fromArray(array_merge(
            $data,
            [UserDTO::ROLE_ID => Role::STUDENT]
        ));
    }
}
