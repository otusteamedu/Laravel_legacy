<?php
/**
 * Интерфейс репозитория для валют
 */

namespace App\Services\Currencies\Repositories;


interface CurrencyRepositoryInterface
{
    public function find(int $id);

    public function searchByCode(string $code = '');

    public function all();

    public function createFromArray(array $data);

    public function updateFromArray(int $id, array $data);

    public function delete(int $id);
}
