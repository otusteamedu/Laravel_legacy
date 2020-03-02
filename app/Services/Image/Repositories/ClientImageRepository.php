<?php


namespace App\Services\Image\Repositories;


use App\Models\Image;
use App\Services\Base\Resource\Repositories\ClientBaseResourceRepository;
use Illuminate\Contracts\Pagination\Paginator;
use App\Services\Image\Resources\ImageDetailed as ImageDetailedResource;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientImageRepository extends ClientBaseResourceRepository
{
    public function __construct(Image $model)
    {
        $this->model = $model;
    }

    /**
     * @return Collection
     */
    public function index(): Collection
    {
        return $this->model::select(['id', 'path', 'format_id'])
            ->where('publish', 1)
            ->get();
    }
}
