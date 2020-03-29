<?php


namespace App\Services\Projects\Handlers;


use App\Models\Project;
use App\Services\Projects\Repositories\EloquentProjectRepository;

class CreateProjectHandler
{

    private $projectRepository;

    public function __construct(
        EloquentProjectRepository $projectRepository
    )
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * @param array $data
     * @return Project
     */
    public function handle(array $data): Project
    {
        return $this->projectRepository->createFromArray($data);
    }

}
