<?php
/**
 * Description of CreateUserHandler.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Users\Handlers;


use App\Models\User;
use App\Services\Users\Repositories\UserRepository;

class CreateUserHandler
{

    /** @var UserRepository */
    private $userRepository;

    public function __construct(
        UserRepository $userRepository
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
        return $this->userRepository->createFromArray($data);
    }

}