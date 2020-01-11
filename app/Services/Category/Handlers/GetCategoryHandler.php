<?php


namespace App\Services\Category\Handlers;


use App\Models\Category;
use App\Services\Category\Repositories\CategoryRepository;

class GetCategoryHandler
{
    /**
     * @var CategoryRepository
     */
    private $repository;

    /**
     * GetCategoryHandler constructor.
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $id
     * @return Category
     */
    public function handle(int $id) : Category {
        return $this->repository->show($id);
    }
}
