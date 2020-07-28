<?php


namespace App\Services\Repositories;

use App\Models\Orders\Order;

/**
 * Class OrdersRepository
 * @package App\Services\Repositories
 */

class OrdersRepository implements RepositoryInterface
{
    public function index()
    {
        return Order::paginate(20);
    }

    public function store(array $data)
    {
        $model = new Order;
        $model->date = $data->date;
        $model->amount = $data->amount;
        $model->client_id = $data->client_id;
        $model->region_id = $data->region_id;
        $model->save();
    }

    public function update(array $data, $model)
    {
        $model->date = $data['date'];
        $model->amount = $data['amount'];
        $model->save();
    }

    public function destroy($model)
    {
        $model->delete();
    }
}
