<?php

namespace App\Services\Tasks\Repositories;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;

class EloquentTasksRepository
{
    public function getForm(int $id)
    {
        $colums = ['id', 'project_id', 'name', 'description', 'user_id'];
        $result = Task::orderBy('id', 'DESC')
            ->select($colums)
            ->with('project', 'user')
            ->paginate($id);
        return $result;
    }

    public function getFormCreate(array $data)
    {
        $task = new Task();
        return $task->create($data);
    }

    public function updateForm(Task $task, array $data)
    {
        return $task->update($data);
    }

    public function destroyTask(Task $task)
    {
        return $task->delete();
    }

}
