<?php


namespace App\Services\Repositories;

use App\Models\Schedule;
use Illuminate\Http\Request;

/**
 * Class ScheduleRepository
 * @package App\Services\Repositories
 */

class ScheduleRepository implements RepositoryInterface
{
    public function index()
    {
        return Schedule::with(['transport', 'region'])->paginate(20);
    }

    public function store(array $data)
    {
        $model = new Schedule;
        $model->name = $data->name;
        $model->region_id = $data->region_id;
        $model->save();
    }

    public function show($id)
    {
        return Schedule::find($id);
    }

    public function edit($id)
    {
        return Schedule::find($id);
    }

    public function update(array $data, $model)
    {
        $truck = Schedule::find($model->id);
        $truck->name = $data->name;
        $truck->region_id = $data->region_id;
        $truck->save();
    }

    public function destroy($model)
    {
        $model->delete();
    }
}
