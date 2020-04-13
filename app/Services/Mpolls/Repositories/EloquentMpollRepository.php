<?php


namespace App\Services\Mpolls\Repositories;


use App\Models\Mpoll;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentMpollRepository implements MpollRepositoryInterface
{
    public function find(int $id)
    {
    }

    public function search(array $filters = []): LengthAwarePaginator
    {
        return Mpoll::paginate();
    }

    public function createFromArray(array $data): Mpoll
    {

    }


    public function updateFromArray(Mpoll $filter, array $data)
    {
    }

}
