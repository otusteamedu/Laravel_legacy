<?php
/**
 * Хэндлер для изменения пользователей
 */

namespace App\Services\Users\Handlers;


use App\Models\User;
use App\Services\Users\Repositories\UserRepositoryInterface;
use Carbon\Carbon;

class UpdateUserHandler
{

    private $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param int $id
     * @param array $data
     * @return User
     */
    public function handle(int $id, array $data): User
    {
        $data['name'] = trim($data['name']);
        $data['email'] = trim($data['email']);
        $data['level'] = intval($data['level']);
        return $this->userRepository->updateFromArray($id, $data);
    }

}
