<?php

namespace App\Services\Users\Handlers;

use App\DTOs\UserDTO;
use App\Models\User;

/**
 * Class UpdateUserHandler
 * @package App\Services\Users\Handlers
 */
class UpdateUserHandler extends BaseHandler
{
    /**
     * @param UserDTO $DTO
     * @param User $user
     * @return User
     */
    public function handle(UserDTO $DTO, User $user): User
    {
        return $this->repository->update($DTO, $user);
    }
}
