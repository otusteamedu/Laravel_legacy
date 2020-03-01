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
     * @param array $data
     * @return mixed
     */
    public function showExcludedImages($category, array $data)
    {
        return Image::whereDoesntHave('owner')
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
        return Image::whereDoesntHave('owner')
            ->where('id', 'like', $data['query'] . '%')
            ->with(config('query_builder.image'))
            ->orderBy($data['sort_by'], $data['sort_order'])
            ->paginate($data['per_page'], ['*'], '', $data['current_page']);
    }

    /**
     * @param $categoryId
     * @param array $imageIds
     */
    public function addImages($categoryId, array $imageIds)
    {
        Image::whereIn('id', $imageIds)->update([
            'owner_id' => $categoryId,
        ]);
    }
}
