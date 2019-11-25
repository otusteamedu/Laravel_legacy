<?php


namespace App\Repositories\Interfaces;

use App\Base\Repository\IBaseRepository;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface IUserRepository extends IBaseRepository
{
    /**
     * @return User|null
     */
    public function currentUser(): ?User;
    /**
     * Авторизация построена на уровнях доступа.
     * Метод принимает код модуля и минимальный уровень доступа
     * @param User $user
     * @param $moduleId
     * @param string $access
     * @return bool
     */
    public function requiredAccess(User $user, $moduleId, string $access): bool;
}
