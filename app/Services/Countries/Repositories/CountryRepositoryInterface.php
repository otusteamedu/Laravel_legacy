<?php
/**
 * Интерфейс репозитория для стран
 */

namespace App\Services\Countries\Repositories;


interface CountryRepositoryInterface
{
    public function find(int $id);

    public function search(array $filters = [], bool $like = false);

    public function createFromArray(array $data);

    public function updateFromArray(int $id, array $data);

    public function delete(int $id);
}
