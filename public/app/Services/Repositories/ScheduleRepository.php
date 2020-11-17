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

    public function store(Request $request)
    {
        $model = new Schedule;
        $model->name = $request->name;
        $model->region_id = $request->region_id;
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

    public function update(Request $request, $model)
    {
        $truck = Schedule::find($model->id);
        $truck->name = $request->name;
        $truck->region_id = $request->region_id;
        $truck->save();
    }

    public function destroy($model)
    {
        $model->delete();
    }
}
