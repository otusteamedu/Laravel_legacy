<?php


namespace App\Services\Category\Repositories;


use App\Models\Category;
use App\Services\Base\Resource\Repositories\ClientBaseResourceRepository;
use Illuminate\Database\Eloquent\Collection;

class ClientCategoryRepository extends ClientBaseResourceRepository
{
    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    /**
     * @return Collection
     */
    public function index(): Collection {
        return $this->model::select(['id', 'type', 'title', 'alias', 'image_path'])
            ->where('publish', 1)
            ->get();
    }
}
