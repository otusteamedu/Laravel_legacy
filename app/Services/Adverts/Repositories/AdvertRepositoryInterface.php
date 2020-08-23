<?php


namespace App\Services\Adverts\Repositories;


use App\Models\Advert;

interface AdvertRepositoryInterface
{

    public function find(int $id);

    public function list();

    public function divisionList();
    public function townList();

    public function paginateList($qty);
    public function filteredPaginateList($qty, $division_id, $town_id);
    public function paginateListApi(int $limit, int $offset);

    public function createFromArray(array $data): Advert;

    public function updateFromArray(Advert $advert, array $data );

    public function destroyFromObj(Advert $advert);

}
