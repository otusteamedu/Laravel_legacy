<?php
/**
 */

namespace App\Services\Tasks\Repositories;


use App\Models\Task;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentTaskRepository implements TaskRepositoryInterface
{

    public function find(int $id)
    {
        return Task::find($id);
    }

    public function search(array $filters = []): LengthAwarePaginator
    {
        return Task::paginate($filters);

    }

    public function searchToArray(array $filters = [])
    {
        if (!empty($filters))
            return Task::where($filters)->get();
        else
            return Task::all()->get();
    }

    public function searchByUsers(array $users = [])
    {
        if (!empty($users)) {
                 return Task::whereIn('user_id', $users)->get();
        } else
            return Task::all()->get();
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