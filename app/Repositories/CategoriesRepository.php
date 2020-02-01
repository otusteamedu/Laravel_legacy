<?php


namespace App\Repositories;

use App\Models\Category;

class CategoriesRepository
{
    const CACHE_SET_TIME_IN_SECONDS = 600;

    /**
     * Get all categories
     *
     * @return mixed
     */
    public function getAllCategories()
    {
        return Category::remember(self::CACHE_SET_TIME_IN_SECONDS)->get();
    }
}