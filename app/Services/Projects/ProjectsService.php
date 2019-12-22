<?php


namespace App\Services\Projects;


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

}
