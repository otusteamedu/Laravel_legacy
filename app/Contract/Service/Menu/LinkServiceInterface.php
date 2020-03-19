<?php


namespace App\Contract\Service\Menu;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

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
}
