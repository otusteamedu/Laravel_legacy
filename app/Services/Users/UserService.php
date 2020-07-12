<?php

namespace App\Services\Users;

use App\DTOs\UserDTO;
use App\Models\User;
use App\Services\Helpers\Locale\Locale;
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
    /** @var Locale  */
    protected $locale;

    /**
     * UserService constructor.
     * @param UserRepositoryInterface $repository
     * @param CreateUserHandler $createUserHandler
     * @param UpdateUserHandler $updateUserHandler
     * @param DeleteUserHandler $deleteUserHandler
     * @param Locale $locale
     */
    public function __construct(
        UserRepositoryInterface $repository,
        CreateUserHandler $createUserHandler,
        UpdateUserHandler $updateUserHandler,
        DeleteUserHandler $deleteUserHandler,
        Locale $locale
    ) {
        $this->repository = $repository;
        $this->createUserHandler = $createUserHandler;
        $this->updateUserHandler = $updateUserHandler;
        $this->deleteUserHandler = $deleteUserHandler;
        $this->locale = $locale;
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
     * @param User $user
     * @return string
     */
    public function getUserLocale(?User $user): string
    {
        if (!$user) {
            return Locale::RU;
        }

        return $user->locale ?? Locale::RU;
    }

    /**
     * @param User $user
     * @param string $locale
     */
    public function setUserLocale(User $user, string $locale): void
    {
        $this->repository->setUserLocale($user, $locale);
    }
}
