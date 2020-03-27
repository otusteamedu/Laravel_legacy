<?php


namespace App\Services\Owner\Repositories;

use App\Models\Image;
use App\Models\Owner;
use App\Services\SubCategory\Repositories\SubCategoryRepository;
use Illuminate\Database\Eloquent\Collection;

class OwnerRepository extends SubCategoryRepository
{
    /**
     * OwnerRepository constructor.
     * @param Owner $model
     */
    public function __construct(Owner $model)
    {
        $this->model = $model;
        $this->table = 'owners';
    }

    /**
     * @param $category
     * @return Collection
     */
    public function getExcludedImageList($category): Collection {
        return Image::whereDoesntHave('owner')
            ->with(config('query_builder.image'))
            ->get();
    }

    /**
     * @param $categoryId
     * @param array $imageIds
     */
    public function addImages($categoryId, array $imageIds) {
        Image::whereIn('id', $imageIds)->update([
            'owner_id' => $categoryId,
        ]);
    }
}
