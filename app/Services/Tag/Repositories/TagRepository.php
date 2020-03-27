<?php


namespace App\Services\Tag\Repositories;

use App\Models\Tag;
use App\Services\SubCategory\Repositories\SubCategoryRepository;

class TagRepository extends SubCategoryRepository
{
    /**
     * TagRepository constructor.
     * @param Tag $model
     */
    public function __construct(Tag $model)
    {
        $this->model = $model;
        $this->table = 'tags';
    }
}
