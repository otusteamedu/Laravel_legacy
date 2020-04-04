<?php
/**
 * Хэндлер для добавления пользователей
 */

namespace App\Services\Users\Handlers;

use Hash;
use App\Models\User;
use App\Services\Users\Repositories\UserRepositoryInterface;
use Carbon\Carbon;

class CreateUserHandler
{

    private $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param array $data
     * @return User
     */
    public function handle(array $data): User
    {
        $data['name'] = trim($data['name']);
        $data['email'] = trim($data['email']);
        $data['level'] = intval($data['level']);
        $data['password'] = Hash::make($data['password']);
        return $this->userRepository->createFromArray($data);
    }

}
