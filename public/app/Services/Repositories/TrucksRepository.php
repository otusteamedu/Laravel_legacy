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

    public function store(Request $request)
    {
        $model = new Truck;
        $model->brand = $request->brand;
        $model->plate = $request->plate;
        $model->cars = $request->cars;
        $model->save();
    }

    public function show($id)
    {
        return Truck::find($id);
    }

    public function edit($id)
    {
        return Truck::find($id);
    }

    public function update(Request $request, $model)
    {
        $truck = Truck::find($model->id);
        $truck->brand = $request->brand;
        $truck->plate = $request->plate;
        $truck->cars = $request->cars;
        $truck->save();
    }

    public function destroy($model)
    {
        $model->delete();
    }
}
