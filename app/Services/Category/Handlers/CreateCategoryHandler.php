<?php


namespace App\Services\Category\Handlers;


use App\Models\CategoryProduct;
use App\Services\Category\Repositories\EloquentCategoryRepository;

class CreateCategoryHandler
{
    private $categoryRepository;

    public function __construct(
        EloquentCategoryRepository $categoryRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function handle(array $data): CategoryProduct
    {
        return $this->categoryRepository->createFromArray($data);
    }
}
