<?php

namespace App\Services\Users;

use App\Models\User;
use App\Services\Users\DTOs\RegisterDTO;
use App\Services\Users\Handlers\UserRegisterHandler;
use App\Services\Users\Repositories\UserRepositoryInterface;

class UsersService
{

    /**
     * @var UserRegisterHandler
     */
    private $userRegisterHandler;
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(
        UserRegisterHandler $userRegisterHandler,
        UserRepositoryInterface $userRepository
    )
    {
        $this->userRegisterHandler = $userRegisterHandler;
        $this->userRepository = $userRepository;
    }

    public function register(RegisterDTO $registerDTO): User
    {
        return $this->userRegisterHandler->handle($registerDTO);
    }
}
