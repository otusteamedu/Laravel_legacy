<?php


namespace App\Services\Tag\Repositories;

use App\Models\Tag;

class ClientTagRepository
{
    /**
     * TagRepository constructor.
     * @param Tag $model
     */
    public function __construct(Tag $model)
    {
        $this->model = $model;
    }

    /**
     * @param int $categoryId
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getFiltersByCategoryId(int $categoryId)
    {
        return $this->model::select(['id', 'title'])
                            ->getFiltersByCategoryId($categoryId)
                            ->withImageCountWhereCategoryId($categoryId)
                            ->published()
                            ->get();
    }

    /**
     * WishList Filters
     * @param array $ids
     * @return mixed
     */
    public function getFiltersByImageIds(array $ids)
    {
        return $this->model::select(['id', 'title'])
            ->getFiltersByImageIds($ids);
    }
}
