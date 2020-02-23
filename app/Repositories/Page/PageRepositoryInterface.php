<?php

namespace App\Repositories\Page;

use App\Models\Page\Page;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Throwable;

/**
 * Interface PageRepositoryInterface
 * @package App\Repositories\Page
 */
interface PageRepositoryInterface
{
    /**
     * Получаем все страницы
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Возвращаем список страниц с пагенацией
     * @param array $options
     * @return LengthAwarePaginator
     */
    public function paginationList(array $options): LengthAwarePaginator;


    /**
     * Получаем страницу по ID
     * @param int $id
     * @return Page
     */
    public function find(int $id): Page;

    /**
     * Создаем страницу по параметрам
     * @param array $data
     * @return Page
     * @throws Throwable
     */
    public function createFromArray(array $data): Page;

    /**
     * Обновляем страницу
     * @param Page $page
     * @param array $data
     * @return Page
     * @throws Throwable
     */
    public function updateFromArray(Page $page, array $data): Page;

    /**
     * Удаляем страницу
     * @param Page $page
     * @throws Throwable
     */
    public function delete(Page $page): void;
}