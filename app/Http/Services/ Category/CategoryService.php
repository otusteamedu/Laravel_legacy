<?php

namespace App\Http\Services\Category;

use App\Http\Handlers\Category\CreateCategoryHandler;
use App\Http\Handlers\Category\DeleteCategoryHandler;
use App\Http\Handlers\Category\UpdateCategoryHandler;
use App\Http\Repositories\Category\CategoryRepository;
use App\Models\Catalog\Category;

class CategoryService{

    protected $createCategoryHandler;

    protected $updateCategoryHandler;

    protected $deleteCategoryHandler;

    protected $categoryRepository;

    public function __construct(
        CreateCategoryHandler $createCategoryHandler,
        UpdateCategoryHandler $updateCategoryHandler,
        DeleteCategoryHandler $deleteCategoryHandler,
        CategoryRepository $categoryRepository
    ) {
        $this->createCategoryHandler = $createCategoryHandler;
        $this->updateCategoryHandler = $updateCategoryHandler;
        $this->deleteCategoryHandler = $deleteCategoryHandler;
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategoryParent(){
        $result = $this->categoryRepository->getParen();
        return $result;
    }

    public function getCategoryPaginate(){
        $result = $this->categoryRepository->getPaginate();
        return $result;
    }

    public function createCategory(array $data){
        $result = $this->createCategoryHandler->handle($data);
        return $result;
    }

    public function updateCategory(Category $category, array $data){
        $result = $this->updateCategoryHandler->handle($category, $data);
        return $result;
    }

    public function deleteCategory(Category $category){
        $result = $this->deleteCategoryHandler->handle($category);
        return $result;
    }
}
