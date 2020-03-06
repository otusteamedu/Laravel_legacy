<?php

namespace App\Services\Base\Category\Repositories;


use App\Models\Image;
use App\Services\Base\Resource\Repositories\CmsBaseResourceRepository;

class CmsBaseCategoryRepository extends CmsBaseResourceRepository
{
    protected string $table = 'categories';

    /**
     * @param $category
     * @param array $pagination
     * @return mixed
     */
    public function getImages($category, array $pagination)
    {
        return $category->images()
            ->with(config('query_builder.image'))
            ->orderBy($pagination['sort_by'], $pagination['sort_order'])
            ->paginate($pagination['per_page'], ['*'], '', $pagination['current_page']);
    }

    /**
     * @param $category
     * @param array $pagination
     * @return mixed
     */
    public function getQueryImages($category, array $pagination)
    {
        return $category->images()
            ->where('id', 'like', $pagination['query'] . '%')
            ->with(config('query_builder.image'))
            ->orderBy($pagination['sort_by'], $pagination['sort_order'])
            ->paginate($pagination['per_page'], ['*'], '', $pagination['current_page']);
    }

    /**
     * @param $category
     * @param array $pagination
     * @return mixed
     */
    public function getExcludedImages($category, array $pagination)
    {
        return Image::whereDoesntHave($this->table, function ($query) use ($category) {
            $query->where('id', $category->id);
        })
            ->with(config('query_builder.image'))
            ->orderBy($pagination['sort_by'], $pagination['sort_order'])
            ->paginate($pagination['per_page'], ['*'], '', $pagination['current_page']);
    }

    /**
     * @param $category
     * @param array $pagination
     * @return mixed
     */
    public function getQueryExcludedImages($category, array $pagination)
    {
        return Image::whereDoesntHave($this->table, function ($query) use ($category) {
            $query->where('id', $category->id);
        })
            ->where('id', 'like', $pagination['query'] . '%')
            ->with(config('query_builder.image'))
            ->orderBy($pagination['sort_by'], $pagination['sort_order'])
            ->paginate($pagination['per_page'], ['*'], '', $pagination['current_page']);
    }

    /**
     * @param mixed $category
     * @param array $images
     */
    public function addImages($category, array $images)
    {
        $category->images()->attach($images, ['category_type' => $category->type]);
    }

    /**
     * @param mixed $category
     * @param int $imageId
     * @return bool|int
     */
    public function removeImage($category, int $imageId)
    {
        return $category->images()->detach($imageId);
    }
}
