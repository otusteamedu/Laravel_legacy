<?php
namespace App\Services\Planner\Proxy\Handlers\Repositories;

use App\Models\Planner\PlannerProxy;

interface ProxyRepositoryInterface
{
    public function find(int $id);

    public function search(array $filters = []);

    public function createFromArray(array $data): PlannerProxy;

    public function updateFromArray(PlannerProxy $proxy, array $data):PlannerProxy;

}
