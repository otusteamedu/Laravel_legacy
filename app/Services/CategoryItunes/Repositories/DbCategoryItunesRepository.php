<?php
namespace App\Services\CategoryItunes\Repositories;


class DbCategoryItunesRepository implements CategoryItunesRepositoryInterface
{
    /**
     * Возвращает массив категорий для iTunes в формате id => name
     * @return array
     */
    public function getAssoc(): array
    {
        $categories = \DB::select("SELECT id, name FROM categories_itunes ORDER BY name");
        return array_combine(array_column($categories, 'id'), array_column($categories, 'name'));
    }
}
