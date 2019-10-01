<?php
namespace App\Services\CategoryItunes\Repositories;


interface CategoryItunesRepositoryInterface
{
    /**
     * Возвращает массив категорий для iTunes в формате id => name
     * @return array
     */
    public function getCategories(): array;
}
