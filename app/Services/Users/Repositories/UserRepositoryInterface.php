<?php
/**
 * Интерфейс репозитория для пользователей
 */

namespace App\Services\Users\Repositories;


interface UserRepositoryInterface
{
    public function find(int $id);

    public function searchByNameOrEmail(string $code = '');

    public function createFromArray(array $data);

    public function updateFromArray(int $id, array $data);

    public function delete(int $id);
}
