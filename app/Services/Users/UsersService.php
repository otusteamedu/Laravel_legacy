<?php
/**
 * Description of UsersService.php
 */

namespace App\Services\Users;
use App\Models\User as User;
use App\Services\Users\Handlers\CreateUserHandler;

class UsersService
{
    private $createUserHandler;
    public function __construct(CreateUserHandler $createUserHandler)
    {
        $this->createUserHandler = $createUserHandler;
    }
    /**
     * @param array $data
     * @return User
     */
    public function createUser(array $data): User
    {
        return $this->createUserHandler->handle($data);
    }

}
