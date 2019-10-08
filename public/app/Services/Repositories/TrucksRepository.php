<?php


namespace App\Services\Repositories;

use App\Models\Transport\Truck;
use Illuminate\Http\Request;

/**
 * Class TrucksRepository
 * @package App\Services\Repositories
 */

class TrucksRepository implements RepositoryInterface
{
    public function index()
    {
        return Truck::paginate(20);
    }

    public function store(array $data)
    {
        $model = new Truck;
        $model->brand = $data['brand'];
        $model->plate = $data['plate'];
        $model->cars = $data['cars'];
        $model->save();
    }

    public function update(array $data, $model)
    {
        $model->brand = $data['brand'];
        $model->plate = $data['plate'];
        $model->cars = $data['cars'];
        $model->save();
    }

    public function destroy($model)
    {
        $model->delete();
    }
}
