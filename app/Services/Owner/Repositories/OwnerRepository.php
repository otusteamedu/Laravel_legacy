<?php


namespace App\Services\Owner\Repositories;

use App\Models\Image;
use App\Models\Owner;
use App\Services\SubCategory\Repositories\SubCategoryRepository;
use Illuminate\Database\Eloquent\Collection;

class OwnerRepository extends SubCategoryRepository
{
    protected string $table = 'owners';

    /**
     * OwnerRepository constructor.
     * @param Owner $model
     */
    public function __construct(Owner $model)
    {
        $this->model = $model;
    }

    /**
     * @param $category
     * @param array $pagination
     * @return mixed
     */
    public function getExcludedImages($category, array $pagination)
    {
        return Image::whereDoesntHave('owner')
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
        return Image::whereDoesntHave('owner')
            ->where('id', 'like', $pagination['query'] . '%')
            ->with(config('query_builder.image'))
            ->orderBy($pagination['sort_by'], $pagination['sort_order'])
            ->paginate($pagination['per_page'], ['*'], '', $pagination['current_page']);
    }

    /**
     * @param mixed $categoryId
     * @param array $imageIds
     */
    public function addImages($categoryId, array $imageIds)
    {
        Image::whereIn('id', $imageIds)->update([
            'owner_id' => $categoryId,
        ]);
    }

    /**
     * @param mixed $categoryId
     * @param int $imageId
     * @return bool|int
     */
    public function removeImage($categoryId, int $imageId)
    {
        $image = Image::findOrFail($imageId);
        $image->owner()->dissociate();
        return $image->save();
    }
}
