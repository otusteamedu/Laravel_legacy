<?php

namespace App\Services\Base\Category\Repositories;


use App\Models\Image;
use App\Services\Base\Resource\Repositories\CmsBaseResourceRepository;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;

abstract class CmsBaseCategoryRepository extends CmsBaseResourceRepository
{
    protected string $table;

    /**
     * @param $category
     * @param array $data
     * @return mixed
     */
    public function showImages($category, array $data)
    {
        return $category->images()
            ->with(config('query_builder.image'))
            ->orderBy($data['sort_by'], $data['sort_order'])
            ->paginate($data['per_page'], ['*'], '', $data['current_page']);
    }

    /**
     * @param $category
     * @param array $data
     * @return mixed
     */
    public function showQuerySearchImages($category, array $data)
    {
        return $category->images()
            ->where('id', 'like', $data['query'] . '%')
            ->with(config('query_builder.image'))
            ->orderBy($data['sort_by'], $data['sort_order'])
            ->paginate($data['per_page'], ['*'], '', $data['current_page']);
    }

    /**
     * @param $category
     * @param array $data
     * @return mixed
     */
    public function showExcludedImages($category, array $data)
    {
        return Image::whereDoesntHave($this->table, function ($query) use ($category) {
            $query->where('id', $category->id);
        })
            ->with(config('query_builder.image'))
            ->orderBy($data['sort_by'], $data['sort_order'])
            ->paginate($data['per_page'], ['*'], '', $data['current_page']);
    }

    /**
     * @param $category
     * @param array $data
     * @return mixed
     */
    public function showQuerySearchExcludedImages($category, array $data)
    {
        return Image::whereDoesntHave($this->table, function ($query) use ($category) {
            $query->where('id', $category->id);
        })
            ->where('id', 'like', $data['query'] . '%')
            ->with(config('query_builder.image'))
            ->orderBy($data['sort_by'], $data['sort_order'])
            ->paginate($data['per_page'], ['*'], '', $data['current_page']);
    }

    /**
     * @param $category
     * @param array $images
     */
    public function addImages($category, array $images)
    {
        $category->images()->attach($images, ['category_type' => $category->type]);
    }

    /**
     * @param $category
     * @param int $imageId
     * @return int
     */
    public function removeImage($category, int $imageId): int
    {
        return $category->images()->detach($imageId);
    }
}
