<?php


namespace App\Services;

use App\Repositories\CategoriesRepository;


class CategoriesService
{
    protected $categoriesRepository;

    public function __construct
    (
        CategoriesRepository $categoriesRepository
    )
    {
        $this->categoriesRepository = $categoriesRepository;
    }

    /**
     * Get all categories
     *
     * @return mixed
     */
    public function getAllCategories()
    {
        return $this->categoriesRepository->getAllCategories();
    }
}