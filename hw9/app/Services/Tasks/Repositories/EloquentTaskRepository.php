<?php
/**
 */

namespace App\Services\Tasks\Repositories;


use App\Models\Task;

class EloquentTaskRepository implements TaskRepositoryInterface
{

    public function find(int $id)
    {
        return Task::find($id);
    }

    public function search(array $filters = [])
    {
        return Task::paginate();

    }

    public function searchToArray(array $filters = [])
    {
        return Task::all()->pluck('name', 'id')->toArray();
    }

    public function createFromArray(array $data): Task
    {
        $task = new Task();
        $task = $task->create($data);
        return $task;
    }

    public function updateFromArray(Task $task, array $data)
    {

        $result = Task::where('name', $data['name'])->get();
        if ((count($result) > 1) || (count($result) == 1 && $result[0]->id != $task->id)) {

            return ['error' => 'Это имя уже успользуется'];
        }
        $task->update($data);
         return 1;
    }

    public function create(array $data): Task
    {
        return $this->createFromArray($data);
    }

    public function delete(int $id)
    {

        return Task::destroy($id);
    }




}