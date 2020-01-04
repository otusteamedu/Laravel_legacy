<?php


namespace Tests\Generators;


use App\Models\Project;
use App\Models\User;

class ProjectGenerator
{
    public static function createForUser(User $user, array $data = [])
    {
        $project = factory(Project::class)->create($data);
        $project->users()->attach($user);
        return $project;
    }
}
