<?php


namespace App\Services\Interfaces;

use App\Base\Service\IBaseService;
use App\Models\User;

interface IUserService extends IBaseService
{
    /**
     * @return User|null
     */
    public function currentUser(): ?User;
}
