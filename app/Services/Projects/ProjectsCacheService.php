<?php

namespace App\Services\Projects;

use App\Models\Project;
use App\Models\ProjectTask;
use App\Models\ProjectUser;
use App\Services\Interfaces\CacheServiceInterface;
use App\Services\Projects\Repositories\EloquentCacheProjectsRepository;

/**
 * Class ProjectsCacheService
 * Сервис для работы с кэшем проектов
 *
 * @package App\Services\Projects
 */
class ProjectsCacheService implements CacheServiceInterface
{

    /** {@inheritDoc} */
    public function clear()
    {
        Project::flushCache(EloquentCacheProjectsRepository::CACHE_TAG);
        ProjectTask::flushCache();
        ProjectUser::flushCache();
    }

    /** {@inheritDoc} */
    public function warm()
    {
        // @todo
    }
}
