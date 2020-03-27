<?php


namespace App\Services\Image\Repositories;


use App\Models\Image;
use App\Services\Base\Resource\Repositories\BaseResourceRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Services\Image\Resources\ImageDetailed as ImageDetailedResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageRepository extends BaseResourceRepository
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
     * @return Collection
     */
    public function index(): Collection {
        return $this->model::with(config('query_builder.image'))->get();
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
