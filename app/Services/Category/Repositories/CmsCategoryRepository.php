<?php


namespace App\Services\Category\Repositories;


use App\Models\Category;
use App\Services\Base\Category\Repositories\CmsBaseCategoryRepository;
use Illuminate\Database\Eloquent\Collection;

class CmsCategoryRepository extends CmsBaseCategoryRepository
{
    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    /**
     * @return Collection
     */
    public function index(): Collection {
        return $this->model::select(['id', 'type', 'title', 'alias'])->get();
    }

    /**
     * @param string $type
     * @return Collection
     */
    public function getItemsByType(string $type): Collection {
        return $this->model::where('type', $type)
            ->withCount('images')
            ->get();
    }
}
