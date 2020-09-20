<?php


namespace App\Services\Repositories;


use App\Models\Advert;

interface RepositoryInterface
{

    public function setModel($modelName);

    public function find(int $id);

    public function list();

    public function paginateList($qty);
    public function filteredPaginateList($qty, $division_id, $town_id);
    public function paginateListApi(int $limit, int $offset);

    public function createFromArray(array $data): object ;

    public function updateFromArray(object $advert, array $data );

    public function destroyFromObj(object $advert);

}
