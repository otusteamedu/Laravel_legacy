<?php


namespace App\Services\Repositories;

use App\Models\Clients\Client;

/**
 * Class ClientsRepository
 * @package App\Services\Repositories
 */

class ClientsRepository implements RepositoryInterface
{
    public function index()
    {

        return Client::with(['region'])->paginate(5);
    }

    public function store(array $data)
    {
        $model = new Client;
        $model->name = $data['name'];
        $model->region_id = $data['region_id'];
        $model->save();
    }

    public function update(array $data, $model)
    {
        $model->name = $data['name'];
        $model->region_id = $data['region_id'];
        $model->save();
    }

    public function destroy($model)
    {
        $model->delete();
    }
}
