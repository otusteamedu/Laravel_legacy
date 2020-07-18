<?php

namespace App\Services\Users\Handlers;

use App\Models\User;
use Exception;

/**
 * Class DeleteUserHandler
 * @package App\Services\Users\Handlers
 */
class DeleteUserHandler extends BaseHandler
{
    /**
     * @param User $user
     * @return bool
     * @throws Exception
     */
    public function handle(User $user): bool
    {
        return $this->repository->delete($user);
    }
}
