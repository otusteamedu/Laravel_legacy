<?php

namespace App\Services\Users;

use App\Models\User;
use App\Services\Users\DTOs\RegisterDTO;
use App\Services\Users\Handlers\UserRegisterHandler;
use App\Services\Users\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

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

    /**
     * Регистрация пользователя
     * @param array $data
     * @return User
     */
    public function register(array $data): User
    {
        $user =  RegisterDTO::fromArray([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return $this->userRegisterHandler->handle($user);
    }
}
