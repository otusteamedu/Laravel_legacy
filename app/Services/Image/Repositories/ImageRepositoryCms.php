<?php


namespace App\Services\Image\Repositories;


use App\Models\Image;
use App\Services\Base\Resource\Repositories\CmsBaseResourceRepository;
use Illuminate\Contracts\Pagination\Paginator;
use App\Services\Image\Resources\ImageDetailed as ImageDetailedResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageRepositoryCms extends CmsBaseResourceRepository
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
     * @param $data
     * @return Paginator
     */
    public function paginateIndex($data)
    {
        return $this->model::with(config('query_builder.image'))
            ->orderBy($data['sort_by'], $data['sort_order'])
            ->paginate($data['per_page'], ['*'], '', $data['current_page']);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function paginateQuerySearchIndex(array $data)
    {
        return $this->model::where('id', 'like', $data['query'] . '%')
            ->with(config('query_builder.image'))
            ->orderBy($data['sort_by'], $data['sort_order'])
            ->paginate($data['per_page'], ['*'], '', $data['current_page']);
    }

    /**
     * @param int $id
     * @return JsonResource
     */
    public function showDetailed(int $id): JsonResource {
        return new ImageDetailedResource($this->model::findOrFail($id));
    }

    /**
     * @param string $relation
     * @param $syncData
     * @param Image $image
     */
    public function syncAssociations(string $relation, $syncData, Image $image) {
        $image->$relation()->sync($syncData);
    }

    /**
     * @param array $data
     * @param Image $image
     */
    public function fillAttributesFromArray(array $data, Image $image) {
        $image->fill($data)->save();
    }
}
