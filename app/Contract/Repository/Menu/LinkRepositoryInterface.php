<?php


namespace App\Contract\Repository\Menu;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

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
}
