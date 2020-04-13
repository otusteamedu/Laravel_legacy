<?php


namespace App\Services\Mpolls\Repositories;


use App\Models\Mpoll;

interface MpollRepositoryInterface
{
    public function find(int $id);

    public function search(array $filters = []);

    public function createFromArray(array $data): Mpoll;


    public function updateFromArray(Mpoll $filter, array $data);
}
