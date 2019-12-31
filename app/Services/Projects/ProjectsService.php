<?php


namespace App\Services\Projects;


use App\Models\Project;
use App\Services\Projects\Repositories\EloquentProjectRepository;

class ProjectsService
{
    protected $projectsRepository;

    public function __construct(EloquentProjectRepository $projectRepository)
    {
        $this->projectsRepository = $projectRepository;
    }

    public function getAll(int $paginate)
    {
        return $this->projectsRepository->getProjects($paginate);
    }

    public function saveForm(array $data)
    {
        return $this->projectsRepository->createProject($data);
    }

    public function updateForm(Project $project,array $data)
    {
        return $this->projectsRepository->updateProject($project, $data);
    }

    public function delForm(int $id)
    {
        return $this->projectsRepository->delProject($id);
    }

}
