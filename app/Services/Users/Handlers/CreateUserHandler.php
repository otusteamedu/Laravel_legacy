<?php

namespace App\Services\Users\Handlers;

use App\DTOs\UserDTO;
use App\Models\User;
use App\Services\Users\Exceptions\UserCreateException;

class CreateUserHandler extends BaseHandler
{
    /**
     * @param UserDTO $DTO
     * @return User
     */
    public function handle(UserDTO $DTO): User
    {
        if ($user = $this->repository->getByEmail($DTO)) {
            return $user;
        }

        $user = $this->repository->store($DTO);

        if (!$user) {
            throw new UserCreateException();
        }

        return $user;
    }
}
