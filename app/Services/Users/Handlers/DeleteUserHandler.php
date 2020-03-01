<?php

namespace App\Services\Users\Handlers;

use App\Models\User;
use App\Services\Users\Repositories\EloquentUserRepository;

/**
 * Class DeleteUserHandler
 * @package App\Services\Users\Handlers
 */
class DeleteUserHandler {
    private $userRepository;

    public function __construct(
        EloquentUserRepository $userRepository //@ToDO: переделать красиво на UserRepositoryInterface по уроку об DI
    )
    {
        $this->userRepository = $userRepository;
    }

    public function handle(User $user): void
    {
        $user->delete();
    }
}
