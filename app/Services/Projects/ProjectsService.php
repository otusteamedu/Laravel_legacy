<?php


namespace App\Services\Projects;


use App\Models\Project;
use App\Services\Projects\Handlers\CreateProjectHandler;
use App\Services\Projects\Repositories\ProjectsRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class ProjectsService
 * Сервис для работы с проектами
 * @package App\Services\Projects
 */
class ProjectsService
{

    /**
     * @var CreateProjectHandler
     */
    private $createProjectHandler;
    /**
     * @var ProjectsRepositoryInterface
     */
    private $projectsRepository;

    /**
     * UsersService constructor.
     * @param CreateProjectHandler        $createProjectHandler
     * @param ProjectsRepositoryInterface $projectsRepository
     */
    public function __construct(
        CreateProjectHandler $createProjectHandler,
        ProjectsRepositoryInterface $projectsRepository
    )
    {
        $this->createProjectHandler = $createProjectHandler;
        $this->projectsRepository = $projectsRepository;
    }

    /**
     * Получить сущность проекта
     * @param int $id
     * @return Project|null
     */
    public function findProject(int $id)
    {
        return $this->projectsRepository->find($id);
    }

    /**
     * Получить список проектов
     * @param int   $limit
     * @return LengthAwarePaginator
     */
    public function searchProjects($limit = 20): LengthAwarePaginator
    {
        return $this->projectsRepository->search($limit);
    }

    /**
     * Создать проект
     * @param array $data
     * @return Project
     */
    public function storeProject(array $data): Project
    {
        $project = $this->createProjectHandler->handle($data);

        return $project;
    }

    /**
     * Обновить данные проекта
     * @param Project $user
     * @param array $data
     * @return Project
     */
    public function updateProject(Project $user, array $data): Project
    {
        return $this->projectsRepository->updateFromArray($user, $data);
    }

    /**
     * Удалить проект
     * @param Project $project
     * @return mixed
     */
    public function deleteProject(Project $project)
    {
        return $this->projectsRepository->delete($project);
    }
}
