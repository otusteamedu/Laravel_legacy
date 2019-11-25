<?php


namespace App\Base\Service;

use App\Base\Repository\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface IBaseService
{
    public function findModel(int $primary): Model;

    public function findByID(int $primary): ?Model;

    public function paginateByFilter(array $filter = [], array $order = [], array &$nav = null): Collection;

    public function findByFilter(array $filter = [], array $order = []): Collection;

    public function findOneByFilter(array $filter = [], array $order = []): ?Model;

    public function store(array $data): Model;

    public function update(int $primary, array $data): Model;

    public function remove(int $primary);

    public function getRepository(): BaseRepository;
}
