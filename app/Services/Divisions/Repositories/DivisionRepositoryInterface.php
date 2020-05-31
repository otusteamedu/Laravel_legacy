<?php


namespace App\Services\Divisions\Repositories;

use App\Models\Division;


interface DivisionRepositoryInterface
{

    public function find(int $id);

    public function list();

    public function search(array $filters = []);

    public function createFromArray(array $data): Division;

    public function updateFromArray(Division $division, array $data );

    public function destroyFromObj(Division $division);

}
