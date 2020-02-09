<?php

namespace App\Repositories\User\Group;

use App\Models\User\Group;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Throwable;

/**
 * Interface GroupRepositoryInterface
 * @package App\Repositories\User\Group
 */
interface GroupRepositoryInterface
{
    /**
     * Получаем все группы
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Возвращаем список групп с пагенацией
     * @param array $options
     * @return LengthAwarePaginator
     */
    public function paginationList(array $options): LengthAwarePaginator;

    /**
     * Получаем группу по ID
     * @param int $id
     * @return Group
     */
    public function find(int $id): Group;

    /**
     * Создаем группу по параметрам
     * @param array $data
     * @return Group
     * @throws Throwable
     */
    public function createFromArray(array $data): Group;

    /**
     * Обновляем группу
     * @param Group $group
     * @param array $data
     * @return Group
     * @throws Throwable
     */
    public function updateFromArray(Group $group, array $data): Group;

    /**
     * Удаляем группу
     * @param Group $group
     * @throws Throwable
     */
    public function delete(Group $group): void;

    /**
     * Возвращает массив групп
     * @param array $options
     * @return array
     */
    public function arrayList(array $options): array;
}