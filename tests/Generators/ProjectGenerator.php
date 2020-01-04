<?php


namespace Tests\Generators;


use App\Models\Project;
use App\Models\Repository;
use App\Models\User;

class ProjectGenerator
{
    public static function createForUser(User $user, array $data = [])
    {
        $project = factory(Project::class)->create($data);
        $project->users()->attach($user);
        return $project;
    }

    public static function createWithLocalGitRepo()
    {
        $url = app()->basePath();
        $repository = factory(Repository::class)->create(['url' => $url]);
        return factory(Project::class)->create(['url' => $url, 'repository_id' => $repository->id]);
    }
}
