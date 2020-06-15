<?php

namespace Tests\Generators;

use App\Models\Project;

/**
 * Class ProjectGenerator
 * Класс генератор проекта для тестов
 * @package Generators
 */
class ProjectGenerator
{
    /**
     * Получить проект
     *
     * @return Project
     */
    public static function generateProject(): Project
    {
        $projects = factory(Project::class, 1)->create();

        return $projects->first();
    }
}
