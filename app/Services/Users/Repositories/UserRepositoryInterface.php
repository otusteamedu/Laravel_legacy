<?php

namespace App\Services\Users\Repositories;

use App\DTOs\UserDTO;
use App\Models\User;

interface UserRepositoryInterface
{
    /**
     * @param User $user
     * @return bool
     * @throws \Exception
     */
    public function delete(User $user): bool;

    /**
     * @param UserDTO $userDTO
     * @param User $user
     * @return User
     */
    public function update(UserDTO $userDTO, User $user): User;

    /**
     * @param UserDTO $DTO
     * @return User
     */
    public function store(UserDTO $DTO): User;

    /**
     * @param UserDTO $DTO
     * @return User|null
     */
    public function getByEmail(UserDTO $DTO): ?User;

    /**
     * @param User $user
     * @param string $locale
     * @return User
     */
    public function setUserLocale(User $user, string $locale): User;
}
