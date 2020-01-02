<?php


namespace App\Repositories;

use App\Base\Repository\BaseRepository;
use App\Models\Order;
use App\Models\User;
use App\Repositories\Interfaces\IOrderRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class OrderRepository extends BaseRepository implements IOrderRepository
{
    /**
     * @param $session_id
     * @return Order|null
     * @throws \App\Base\WrongNamespaceException
     */
    public function getOrderSession($session_id): ?Order {
        return $this->getModel()->newQuery()
            ->where('session_id', $session_id)
            ->get()->first();
    }
    public function createFromArray(array $data): Model
    {
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();
        return parent::createFromArray($data);
    }
    public function updateFromArray(Model $model, array $data): Model
    {
        $data['updated_at'] = Carbon::now();
        return parent::updateFromArray($model, $data);
    }

    public function getUserOrder(User $user, string $order_number): ?Order
    {
        return $this->getModel()->newQuery()
            ->where('buyer_id', $user->id)
            ->where('number', $order_number)
            ->whereNotNull('number')
            ->get()->first();
    }
}
