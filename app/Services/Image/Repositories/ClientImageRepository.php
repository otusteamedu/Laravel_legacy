<?php


namespace App\Services\Image\Repositories;


use App\Models\Image;
use App\Services\Base\Resource\Repositories\ClientBaseResourceRepository;
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
     * @param array $pagination
     * @return Collection
     */
    public function getPublishedImages(array $pagination): Collection
    {
        return $this->model::where('publish', 1)
            ->orderBy('id', $pagination['sort_order'] ?? 'asc')
            ->paginate($pagination['per_page'], ['*'], '', $pagination['current_page']);
    }
}
