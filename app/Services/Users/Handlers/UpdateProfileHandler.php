<?php
/** Description of CreateUserHandler.php */
namespace App\Services\Users\Handlers;

use App\Models\User;
use App\Services\Users\Repositories\UserRepositoryInterface;

class UpdateProfileHandler
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param array $data
     * @return User
     */
    public function handle(User $user, array $data):User
    {
        // если надо, соверши какие-либо манипуляции с $data,
        // подготовь данные или
        // вызови какие-либо события
        // ...
        return $this->userRepository->update($user,$data);
    }
}

