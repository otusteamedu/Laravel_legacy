<?php


namespace App\Services\Image\Repositories;


use App\Models\Image;
use App\Services\Base\Resource\Repositories\ClientBaseResourceRepository;
use App\Services\Image\Resources\ImageToClient as ImageToClientResource;
use App\Services\Image\Resources\ImageToClientCollection;
use App\Services\Image\Resources\ImageToEditor as ImageToEditorResource;
use Illuminate\Database\Eloquent\Collection;

class ClientImageRepository extends ClientBaseResourceRepository
{
    /**
     * ClientImageRepository constructor.
     * @param Image $model
     */
    public function __construct(Image $model)
    {
        $this->model = $model;
    }

    /**
     * @param int $id
     * @return ImageToEditorResource
     */
    public function getResourceItem(int $id): ImageToEditorResource
    {
        return new ImageToEditorResource($this->model::findOrFail($id));
    }

//    /**
//     * @param array $pagination
//     * @return Collection
//     */
//    public function getItems(array $pagination): Collection
//    {
//        return ImageToClientResource::collection($this->model
//            ->load('likes')
//            ->paginate($pagination['per_page'], ['*'], '', $pagination['current_page'])
//            ->published())
//            ->orderBy('id', $pagination['sort_order'] ?? 'asc');
//    }

    /**
     * @param array $ids
     * @param array $pagination
     * @param array|null $filter
     * @return ImageToClientCollection
     */
    public function getWishListItems(array $ids, array $pagination, array $filter = null): ImageToClientCollection
    {
        return new ImageToClientCollection($this->model
            ->whereIn('id', $ids)
            ->published()
            ->when($filter, function ($query, $filter) {
                return $query->filtered($filter);
            })
            ->orderBy('id', $pagination['sort_order'] ?? 'asc')
            ->paginate($pagination['per_page'], ['*'], '', $pagination['current_page'])
        );
    }
}
