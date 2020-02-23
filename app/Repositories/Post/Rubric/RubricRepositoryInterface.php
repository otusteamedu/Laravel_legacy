<?php


namespace App\Repositories\Post\Rubric;

use App\Models\Post\Rubric;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Throwable;

/**
 * Interface RubricRepositoryInterface
 * @package App\Repositories\Post\Rubric
 */
interface RubricRepositoryInterface
{
    /**
     * Получаем все рубрики
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Возвращаем список рубрик с пагенацией
     * @param array $options
     * @return LengthAwarePaginator
     */
    public function paginationList(array $options): LengthAwarePaginator;

    /**
     * Получаем рубрику по ID
     * @param int $id
     * @return Rubric
     */
    public function find(int $id): Rubric;

    /**
     * Создаем рубрику по параметрам
     * @param array $data
     * @return Rubric
     * @throws Throwable
     */
    public function createFromArray(array $data): Rubric;

    /**
     * Обновляем рубрику
     * @param Rubric $rubric
     * @param array $data
     * @return Rubric
     * @throws Throwable
     */
    public function updateFromArray(Rubric $rubric, array $data): Rubric;

    /**
     * Удаляем рубрику
     * @param Rubric $rubric
     * @throws Throwable
     */
    public function delete(Rubric $rubric): void;

    /**
     * Возвращает массив рубрик
     * @param array $options
     * @return array
     */
    public function arrayList(array $options): array;
}