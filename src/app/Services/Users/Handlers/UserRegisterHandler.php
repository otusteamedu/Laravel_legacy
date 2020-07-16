<?php

namespace App\Services\Users\Handlers;

use App\Models\User;
use App\Services\Users\DTOs\RegisterDTO;
use App\Services\Users\Repositories\UserRepositoryInterface;

class UserRegisterHandler
{

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function handle(RegisterDTO $registerDTO): User
    {
        $user = $this->userRepository->register($registerDTO);
        return $user;
    }
}
