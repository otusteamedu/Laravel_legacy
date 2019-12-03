<?php


namespace App\Base\Service;

use App\Base\Repository\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface IBaseService
{
    public function findModel(int $primary): Model;

    public function findByID(int $primary): ?Model;

    public function paginateByFilter(Q $query): Collection;

    public function findByFilter(Q $query): Collection;

    public function findOneByFilter(Q $query): ?Model;

    public function store(array $data): Model;

    public function update(Model $model, array $data): Model;

    public function remove(Model $model);

    public function getRepository(): BaseRepository;
}
