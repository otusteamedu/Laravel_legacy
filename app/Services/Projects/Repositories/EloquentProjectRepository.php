<?php


namespace App\Services\Projects\Repositories;


use App\Models\Project;

class EloquentProjectRepository
{
    public function getProjects(int $paginate)
    {
        $columns = ['id', 'name'];
        $result = Project::orderBy('id', 'DESC')
            ->select($columns)
            ->paginate($paginate);
        return $result;
    }
}
