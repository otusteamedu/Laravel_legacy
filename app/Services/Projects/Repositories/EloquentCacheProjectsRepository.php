<?php

namespace App\Services\Projects\Repositories;

use App\Models\Project;

class EloquentCacheProjectsRepository extends EloquentProjectsRepository implements ProjectsRepositoryInterface
{

    const CACHE_TTL = 60 * 60;

    const CACHE_TAG = 'projects';

    public function find(int $id)
    {
        return Project::remember(self::CACHE_TTL)->cacheTags(self::CACHE_TAG)->whereId($id)->first();
    }

    public function search(int $limit = 20)
    {
        return Project::remember(self::CACHE_TTL)->cacheTags(self::CACHE_TAG)->paginate($limit);
    }
}
