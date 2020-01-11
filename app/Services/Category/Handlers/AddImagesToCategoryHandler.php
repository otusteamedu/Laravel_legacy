<?php


namespace App\Services\Category\Handlers;


use App\Models\Category;
use App\Services\Category\Repositories\CategoryRepository;

class AddImagesToCategoryHandler
{
    /**
     * @var CategoryRepository
     */
    private $repository;

    /**
     * AddImagesToCategoryHandler constructor.
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Category $category
     * @param array $images
     */
    public function handle(Category $category, array $images) {
        $this->repository->addImages($category, $images);
    }
}
