<?php
/**
 * Базовый интерфейс для сервисов
 */

namespace App\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface BaseServiceInterface
{

    /**
     * @param int $id
     * @return array|null
     */
    public function find(int $id);

    /**
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function search(array $filters);

    /**
     * @param array $data
     * @return array
     */
    public function store(array $data);

    /**
     * @param int $id
     * @param array $data
     * @return array
     */
    public function update(int $id, array $data);
}
