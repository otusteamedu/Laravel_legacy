<?php

namespace App\Services\CategoryItunes;

use App\Services\CategoryItunes\Repositories\CategoryItunesRepositoryInterface;

class CategoryItunesService
{
    /**
     * @var CategoryItunesRepositoryInterface
     */
    private $categoryItunesRepository;

    public function __construct(CategoryItunesRepositoryInterface $categoryItunesRepository)
    {
        $this->categoryItunesRepository = $categoryItunesRepository;
    }

    /**
     * Возвращает массив категорий для iTunes в формате id => name
     * @return array
     */
    public function getAssoc(): array
    {
        return $this->categoryItunesRepository->getAssoc();
    }
}
