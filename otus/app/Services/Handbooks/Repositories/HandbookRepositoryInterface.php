<?php


namespace App\Services\Handbooks\Repositories;


use App\Models\Handbook;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface HandbookRepositoryInterface {

    public function find(int $id);

    public function search(): LengthAwarePaginator;

    public function destroy(array $ids);

    public function createFromArray(array $data): Handbook;

    public function updateFromArray(Handbook $handbook, array $data): Handbook;
}
