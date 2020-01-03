<?php

namespace App\Services\Tasks\Repositories;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;

class EloquentTasksRepository
{
    public function getTasks(int $id)
    {
        $colums = ['id', 'project_id', 'name', 'description', 'user_id'];
        $result = Task::orderBy('id', 'DESC')
            ->select($colums)
            ->with('project', 'user')
            ->paginate($id);
        return $result;
    }

    public function createTask(array $data)
    {
        $task = new Task();
        return $task->create($data);
    }

    public function updateTask(Task $task, array $data)
    {
        return $task->update($data);
    }

    public function destroyTask(int $id)
    {
        return Task::destroy($id);
    }

    public function getProjects()
    {
        return Project::pluck('name', 'id');
    }

    public function getUsers()
    {
        return User::pluck('name', 'id');
    }


}
