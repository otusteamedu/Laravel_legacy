<?php


namespace App\Services\Interfaces;

use App\Base\Service\IBaseService;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

interface IUserService extends IBaseService
{
    /**
     * @return User|null
     */
    public function currentUser(): ?User;

    public function quickRegister(array $data): User;

    public function findByEmail(string $value): ?User;

    public function findByPhone(string $value): ?User;
}
