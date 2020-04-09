<?php


namespace App\Services\Image\Repositories;


use App\Models\Image;
use App\Services\Base\Resource\Repositories\CmsBaseResourceRepository;
use Illuminate\Contracts\Pagination\Paginator;
use App\Services\Image\Resources\ImageToEdit as ImageToEditResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CmsImageRepository extends CmsBaseResourceRepository
{
    /**
     * ImageRepository constructor.
     * @param Image $model
     */
    public function __construct(Image $model)
    {
        $this->model = $model;
    }

    /**
     * @param int $id
     * @return JsonResource
     */
    public function getItemToEdit(int $id): JsonResource
    {
        return new ImageToEditResource($this->model::findOrFail($id));
    }

    /**
     * @param array $pagination
     * @return Paginator
     */
    public function getItems(array $pagination)
    {
        return $this->model::with(config('query_builder.image'))
            ->orderBy($pagination['sort_by'], $pagination['sort_order'])
            ->paginate($pagination['per_page'], ['*'], '', $pagination['current_page']);
    }

    /**
     * @param array $pagination
     * @return mixed
     */
    public function getQueryItems(array $pagination)
    {
//        ->when($sortBy, function ($query, $sortBy) {
//            return $query->orderBy($sortBy);
//        }, function ($query) {
//            return $query->orderBy('name');
//        })
        return $this->model::where('id', 'like', $pagination['query'] . '%')
            ->with(config('query_builder.image'))
            ->orderBy($pagination['sort_by'], $pagination['sort_order'])
            ->paginate($pagination['per_page'], ['*'], '', $pagination['current_page']);
    }

    /**
     * @param Image $image
     * @param string $relation
     * @param $syncData
     */
    public function syncAssociations(Image $image, string $relation, $syncData)
    {
        $image->$relation()->sync($syncData);
    }

    /**
     * @param Image $image
     * @param array $fillData
     */
    public function fillAttributesFromArray(Image $image, array $fillData)
    {
        $image->fill($fillData)->save();
    }
}
