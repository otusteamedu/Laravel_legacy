<?php


namespace App\Services\Towns\Repositories;


use App\Models\Town;

interface TownRepositoryInterface
{

    public function find(int $id);

    public function list();

    public function search(array $filters = []);

    public function createFromArray(array $data): Town;

    public function updateFromArray(Town $town, array $data);

    public function destroyFromObj(Town $town);

}
