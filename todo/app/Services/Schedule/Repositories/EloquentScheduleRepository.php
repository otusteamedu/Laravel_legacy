<?php
/**
 */

namespace App\Services\Schedule\Repositories;


use App\Models\Schedule;

class EloquentScheduleRepository implements ScheduleRepositoryInterface
{

    public function find(int $id)
    {
        return Schedule::find($id);
    }

    public function search(array $filters = [])
    {
        return Schedule::paginate();

    }

    public function searchToArray(array $filters = [])
    {
        return Schedule::all();
    }

    public function createFromArray(array $data): Schedule
    {
        $schedule = new Schedule();
        $schedule = $schedule->create($data);
        return $schedule;
    }

    public function updateFromArray(Schedule $schedule, array $data)
    {
        $result = Schedule::where('name', $data['name'])->get();
        if ((count($result) > 1) || (count($result) == 1 && $result[0]->id != $schedule->id)) {

            return ['error' => 'Это имя уже успользуется'];
        }
        $schedule->update($data);
        return 1;
    }

    public function create(array $data): Schedule
    {
        return $this->createFromArray($data);
    }

    public function delete(int $id)
    {
        return Schedule::destroy($id);
    }

}