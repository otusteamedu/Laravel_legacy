<?php
/**
 * Интерфейс репозитория для доходов
 */

namespace App\Services\Income\Repositories;


interface IncomeRepositoryInterface
{
    public function search(string $search = '');

    public function sum(string $search = '');

    public function createFromArray(array $data);
    /*
    public function updateFromArray(int $id, array $data);

    public function delete(int $id);
    */
}
