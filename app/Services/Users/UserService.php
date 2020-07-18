<?php

namespace App\Services\Users;

use App\DTOs\UserDTO;
use App\Models\Role;
use App\Models\User;
use App\Services\Interfaces\CacheService;
use App\Services\Traits\CacheClearable;
use App\Services\Users\Handlers\CreateUserHandler;
use App\Services\Users\Handlers\DeleteUserHandler;
use App\Services\Users\Handlers\UpdateUserHandler;
use App\Services\Users\Repositories\UserRepositoryInterface;
use Exception;

/**
 * Class UserService
 * @package App\Services\Users
 */
class UserService implements CacheService
{
    use CacheClearable;

    const CACHE_TAG = 'USER';

    /** @var  UserRepositoryInterface */
    protected $repository;
    /** @var CreateUserHandler */
    protected $createUserHandler;
    /** @var UpdateUserHandler */
    protected $updateUserHandler;
    /** @var DeleteUserHandler */
    protected $deleteUserHandler;

    /**
     * UserService constructor.
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
     * @param int $roleId
     * @return UserDTO
     */
    public function prepareUserDTOForRole(array $data, int $roleId): UserDTO
    {
        return UserDTO::fromArray(array_merge(
            $data,
            [UserDTO::ROLE_ID => $roleId]
        ));
    }

    /**
     * @param User|null $user
     * @return bool
     */
    public function checkIsStudent(?User $user): bool
    {
        if ($user && $user->isStudent()) {
            return true;
        }

        return false;
    }

    /**
     * @param array $data
     * @param User $teacher
     * @return UserDTO
     */
    public function prepareUserDTOFromTeacher(array $data, User $teacher): UserDTO
    {
        return UserDTO::fromArray([
            UserDTO::LAST_NAME => $data['last_name'] ?? $teacher->last_name,
            UserDTO::NAME => $data['name'] ?? $teacher->name,
            UserDTO::SECOND_NAME => $data['second_name'] ?? $teacher->second_name,
            UserDTO::EMAIL => $data['$this->email'] ?? $teacher->email,
            UserDTO::PASSWORD => $data['$this->password'] ?? $teacher->password,
            UserDTO::ROLE_ID => Role::TEACHER,
        ]);
    }

    public function cacheWarm(): void
    {
        // TODO: Implement cacheWarm() method.
    }
}
