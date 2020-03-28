<?php


namespace App\Services\Categories\Handlers;


use App\Models\Category;
use App\Services\Categories\Repositories\EloquentCategoryRepository;

class CreateCategoryHandler
{

    private $categoryRepository;

    public function __construct(
        EloquentCategoryRepository $categoryRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param array $data
     * @return Category
     */
    public function handle(array $data): Category
    {
        return $this->categoryRepository->createFromArray($data);
    }

}
