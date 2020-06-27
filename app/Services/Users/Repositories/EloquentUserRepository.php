<?php

namespace App\Services\Users\Repositories;

use App\DTOs\UserDTO;
use App\Models\Group;
use App\Models\User;

class EloquentUserRepository implements UserRepositoryInterface
{
    /**
     * @param User $user
     * @return bool
     * @throws \Exception
     */
    public function delete(User $user): bool
    {
        /**
         * TODO удалять students
         */
        return $user->delete();
    }

    /**
     * @param UserDTO $userDTO
     * @param User $user
     * @return User
     */
    public function update(UserDTO $userDTO, User $user): User
    {
        $user->update($userDTO->toArray());
        return $user;
    }

    /**
     * @param UserDTO $DTO
     * @return User
     */
    public function store(UserDTO $DTO): User
    {
        return User::create($DTO->toArray());
    }

    /**
     * @param UserDTO $DTO
     * @return User|null
     */
    public function getByEmail(UserDTO $DTO): ?User
    {
        if ($email = $DTO->toArray()['email']) {
            return Group::email($email)->first();
        }

        return null;
    }
}
