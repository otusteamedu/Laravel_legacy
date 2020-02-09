<?php

namespace App\Repositories\User\Right;

use App\Models\User\Right;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface RightRepositoryInterface
 * @package App\Repositories\User\Right
 */
interface RightRepositoryInterface
{
    /**
     * Получаем все права
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Возвращаем список прав с пагенацией
     * @param array $options
     * @return LengthAwarePaginator
     */
    public function paginationList(array $options): LengthAwarePaginator;

    /**
     * Возвращает массив прав
     * @param array $options
     * @return array
     */
    public function arrayList(array $options): array;
}