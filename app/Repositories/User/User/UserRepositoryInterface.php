<?php

namespace App\Repositories\User\User;

use App\Models\User\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Throwable;

/**
 * Interface UserRepositoryInreface
 * @package App\Repositories\User\User
 */
interface UserRepositoryInterface
{
    /**
     * Получаем всех пользователей
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Возвращаем список пользователей с пагенацией
     * @param array $options
     * @return LengthAwarePaginator
     */
    public function paginationList(array $options = []): LengthAwarePaginator;

    /**
     * Получаем пользователя по ID
     * @param int $id
     * @return User
     */
    public function find(int $id): User;

    /**
     * Создаем пользователя по параметрам
     * @param array $data
     * @return User
     * @throws Throwable
     */
    public function createFromArray(array $data): User;

    /**
     * Обновляем пользователя
     * @param User $user
     * @param array $data
     * @return User
     * @throws Throwable
     */
    public function updateFromArray(User $user, array $data): User;

    /**
     * Удаляем пользователя
     * @param User $user
     * @throws Throwable
     */
    public function delete(User $user): void;
}