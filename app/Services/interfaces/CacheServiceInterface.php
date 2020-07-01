<?php


namespace App\Services\Interfaces;


interface CacheServiceInterface
{
    /**
     * Очистить кэш
     */
    public function clear();

    /**
     * Создать кэш
     */
    public function warm();
}
