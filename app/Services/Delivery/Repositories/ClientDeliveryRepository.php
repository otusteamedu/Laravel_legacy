<?php


namespace App\Services\Delivery\Repositories;


use App\Models\Delivery;
use App\Services\Base\Resource\Repositories\ClientBaseResourceRepository;
use Illuminate\Database\Eloquent\Collection;

class ClientDeliveryRepository extends ClientBaseResourceRepository
{
    /**
     * ClientDeliveryRepository constructor.
     * @param Delivery $model
     */
    public function __construct(Delivery $model)
    {
        $this->model = $model;
    }

    /**
     * @return Collection
     */
    public function index(): Collection
    {
        return $this->model::published()
            ->orderBy('order')->get();
    }
}
