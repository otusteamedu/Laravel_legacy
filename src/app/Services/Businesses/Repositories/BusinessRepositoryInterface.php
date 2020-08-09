<?php

namespace App\Services\Businesses\Repositories;

use App\Models\Business;
use App\Services\Businesses\DTOs\BusinessHandlerDTO;

interface BusinessRepositoryInterface
{
    /**
     * Найти запись по ID
     * @param int $id
     * @return Business|null
     */
    public function find(int $id): ?Business;

    /**
     * Вернет салон пользователя
     * @param int $user_id
     * @return Business|null
     */
    public function findByUserId(int $user_id): ?Business;

    /**
     * Создать запись
     * @param BusinessHandlerDTO $businessDTO
     * @return Business|null
     */
    public function create(BusinessHandlerDTO $businessDTO): ?Business;

    /**
     * Обновить запись
     * @param Business $business
     * @return Business
     */
    public function update(Business $business): Business;
//    public function get();
//    public function search(array $filter = []);

    /**
     * Удалить запись
     * @param Business $business
     * @return bool
     */
    public function delete(Business $business): bool;
}
