<?php

namespace App\Services\SubCategory\Repositories;


use App\Services\Base\Category\Repositories\CmsBaseCategoryRepository;
use Illuminate\Database\Eloquent\Collection;

abstract class SubCategoryRepository extends CmsBaseCategoryRepository
{
    /**
     * @return Collection
     */
    public function index(): Collection {
        return $this->model::withCount('images')->get();
    }

    /**
     * @param $category
     * @param array $images
     */
    public function addImages($category, array $images) {
        $category->images()->attach($images);
    }
}
