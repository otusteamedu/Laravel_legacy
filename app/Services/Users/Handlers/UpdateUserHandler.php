<?php

namespace App\Services\Users\Handlers;

use App\Models\User;
use App\Services\Users\Repositories\EloquentUserRepository;

/**
 * Class UpdateUserHandler
 * @package App\Services\Users\Handlers
 */
class UpdateUserHandler {
    private $userRepository;

    public function __construct(
        EloquentUserRepository $userRepository // @ToDO: переделать красиво на UserRepositoryInterface по уроку об DI
    )
    {
        $this->userRepository = $userRepository;
    }

    public function handle(User $user, array $data): User
    {
        if (isset($data['name'])) {
            $data['name'] = ucfirst($data['name']);
        }

        if (isset($data['last_name'])) {
            $data['last_name'] = ucfirst($data['last_name']);
        }

        if (isset($data['region'])) {
            $data['region'] = ucfirst($data['last_name']);
        }

        if (isset($data['password'])) {
            $data['password'] = trim($data['password']);
        } else {
            $data['password'] = $user->password;
        }

        return $this->userRepository->updateFromArray($user, $data);
    }
}
