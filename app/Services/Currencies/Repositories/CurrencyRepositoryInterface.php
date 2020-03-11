<?php
/**
 * Интерфейс репозитория для валют
 */

namespace App\Services\Currencies\Repositories;


interface CurrencyRepositoryInterface
{
    public function find(int $id);

    public function search(array $filters = []);

    public function all();

    public function createFromArray(array $data);

    public function updateFromArray(int $id, array $data);

    public function delete(int $id);
}
