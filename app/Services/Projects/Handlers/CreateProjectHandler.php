<?php


namespace App\Services\Projects\Handlers;


use App\Models\Project;
use App\Services\Projects\Repositories\ProjectsRepositoryInterface;
use Carbon\Carbon;

class CreateProjectHandler
{

    /**
     * @var ProjectsRepositoryInterface
     */
    private $projectRepository;

    public function __construct(
        ProjectsRepositoryInterface $projectRepository
    )
    {
        $this->projectRepository = $projectRepository;
    }


    public function handle(array $data): Project
    {
        $data['created_at'] = Carbon::create()->subDay();

        return $this->projectRepository->createFromArray($data);
    }
}
