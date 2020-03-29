<?php

namespace App\Services\Users\Handlers;

use App\Models\User;
use App\Services\Users\Repositories\UserRepositoryInterface;

/**
 * Class UpdateUserHandler
 * @package App\Services\Users\Handlers
 */
class UpdateUserHandler {
    private $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository
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

        if (isset($data['picture_id'])) {
            $data['picture_id'] = (int)$data['picture_id'];
        } else {
            $data['picture_id'] = $user->picture_id;
        }

        return $this->userRepository->updateFromArray($user, $data);
    }
}
