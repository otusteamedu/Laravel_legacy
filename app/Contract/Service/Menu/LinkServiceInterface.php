<?php


namespace App\Contract\Service\Menu;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface LinkServiceInterface
 * @package App\Contract\Service\Menu
 *
 * Интерфейс сервиса ссылок меню
 */
interface LinkServiceInterface
{
    /**
     * Возвращает список всех ссылок постранично
     * @return LengthAwarePaginator
     */
    public function getList(): LengthAwarePaginator;

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
     */
    public function update(int $id, array $data);

    /**
     * Удаляет ссылку
     * @param int $id идентификатор ссылки
     */
    public function destroy(int $id);
}
