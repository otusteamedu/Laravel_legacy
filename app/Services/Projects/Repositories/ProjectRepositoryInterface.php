<?php

namespace App\Services\Projects\Repositories;

use App\Models\Project;

interface ProjectRepositoryInterface
{

    public function find(int $id);

    public function search(array $filters = []);

    public function createFromArray(array $data): Project;

    public function updateFromArray(Project $segment, array $data);

}
