<?php
/**
 * Хэндлер для удаления пользователей
 */

namespace App\Services\Users\Handlers;

use App\Services\Users\Repositories\UserRepositoryInterface;
use Carbon\Carbon;

class DeleteUserHandler
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
     * @return bool
     */
    public function handle(int $id): bool
    {
        return $this->userRepository->delete($id);
    }

}
