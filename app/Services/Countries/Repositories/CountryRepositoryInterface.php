<?php
/**
 * Интерфейс репозитория для стран
 */

namespace App\Services\Countries\Repositories;


interface CountryRepositoryInterface
{
    public function find(int $id);

    public function searchByNames(string $name = '');

    public function createFromArray(array $data);

    public function updateFromArray(int $id, array $data);

    public function delete(int $id);
}
