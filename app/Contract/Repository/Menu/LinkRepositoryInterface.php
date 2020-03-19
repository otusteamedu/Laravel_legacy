<?php


namespace App\Contract\Repository\Menu;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface LinkRepositoryInterface
 * @package App\Contract\Repository\Menu
 *
 * Интерфейс репозитория ссылок
 */
interface LinkRepositoryInterface
{
    /**
     * Возвращает список всех ссылок постранично
     * @param int $size размер страницы
     * @return LengthAwarePaginator
     */
    public function paginate(int $size): LengthAwarePaginator;

    /**
     * Создает новую ссылку по данным
     * @param array $data данные
     * @return int идентификатор
     */
    public function create(array $data): int;

    /**
     * Обновляет ссылку по данным
     * @param int $id идентификатор ссылки
     * @param array $data данные
     * @return bool
     */
    public function update(int $id, array $data): bool;

    /**
     * Удаляет ссылку
     * @param int $id идентификатор ссылки
     * @return bool
     */
    public function destroy(int $id): bool;
}
