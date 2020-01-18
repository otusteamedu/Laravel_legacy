<?php

namespace App\Services\Base\Category\Repositories;


use App\Models\Image;
use App\Services\Base\Resource\Repositories\BaseResourceRepository;
use Illuminate\Database\Eloquent\Collection;

abstract class BaseCategoryRepository extends BaseResourceRepository
{
    protected $table;

    /**
     * @param $category
     * @return Collection
     */
    public function getImageList($category): Collection {
        return $category->images()
            ->with(config('query_builder.image'))
            ->get();
    }

    /**
     * @param $category
     * @return Collection
     */
    public function getExcludedImageList($category): Collection {
        return Image::whereDoesntHave($this->table, function ($query) use ($category) {
            $query->where('id', $category->id);
        })
            ->with(config('query_builder.image'))
            ->get();
    }

    /**
     * @param $category
     * @param array $images
     */
    public function addImages($category, array $images) {
        $category->images()->attach($images, ['category_type' => $category->type]);
    }

    /**
     * @param $category
     * @param int $imageId
     * @return int
     */
    public function removeImage($category, int $imageId): int {
        return $category->images()->detach($imageId);
    }
}
