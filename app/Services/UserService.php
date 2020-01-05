<?php
/**
 * Description of CitiesService.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services;
use App\Models\User as User;
use App\Services\StoreUserHandler;

class UserService
{
    private $storeUserHandler;
    public function __construct(StoreUserHandler $storeUserHandler)
    {
        $this->storeUserHandler = $storeUserHandler;
    }
    /**
     * @param array $data
     * @return User
     */
    public function storeUser(array $data): User
    {
        return $this->storeUserHandler->handle($data);
    }

}
