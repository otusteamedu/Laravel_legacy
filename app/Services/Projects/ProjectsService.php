<?php


namespace App\Services\Projects;

use App\Models\Project;
use App\Services\Projects\Handlers\CreateProjectHandler;
use App\Services\Projects\Repositories\ProjectRepositoryInterface;


class ProjectsService
{
    private $projectRepository;
    private $createProjectHandler;

    public function __construct(
        CreateProjectHandler $createProjectHandler,
        ProjectRepositoryInterface $projectRepository
    )
    {
        $this->createProjectHandler = $createProjectHandler;
        $this->projectRepository = $projectRepository;
    }

    /**
     * @param array $data
     * @return Project
     */
    public function storeProject(array $data): Project
    {
        return $this->createProjectHandler->handle($data);
    }

}
