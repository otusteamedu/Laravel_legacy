<?php


namespace Tests\Generators;


use App\Models\Project;

/**
 * Class ProjectGenerator
 * @package Tests\Generators
 */
class ProjectGenerator
{
    /**
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
    public function createProject (array $data = [])
    {
        return factory(Project::class)->create($data);
    }
}
