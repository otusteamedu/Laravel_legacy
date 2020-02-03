<?php


namespace App\Services\Category\Handlers;


use App\Models\CategoryProduct;
use App\Services\Category\Repositories\CategoryRepositoryInterface;

class CreateCategoryHandler
{
    private $categoryRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param array $data
     * @return CategoryProduct
     */
    public function handle(array $data): CategoryProduct
    {
        return $this->categoryRepository->createFromArray($data);
    }
}
