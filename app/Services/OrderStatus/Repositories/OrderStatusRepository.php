<?php


namespace App\Services\OrderStatus\Repositories;

use App\Models\OrderStatus;
use App\Services\Base\Resource\Repositories\CmsBaseResourceRepository;
use App\Services\OrderStatus\Resources\OrderStatusWithPivotDate;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderStatusRepository extends CmsBaseResourceRepository
{
    /**
     * CmsRoleRepository constructor.
     * @param OrderStatus $model
     */
    public function __construct(OrderStatus $model)
    {
        $this->model = $model;
    }

    /**
     * @return ResourceCollection
     */
    public function index(): ResourceCollection
    {
        return OrderStatusWithPivotDate::collection($this->model::all());
    }

    /**
     * @param string $alias
     * @return mixed
     */
    public function getItemByAlias(string $alias)
    {
        return $this->model::where('alias', $alias)->firstOrFail();
    }
}
