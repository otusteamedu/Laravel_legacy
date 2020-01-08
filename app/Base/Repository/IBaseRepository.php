<?php


namespace App\Base\Repository;

use App\Base\Service\Q;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface IBaseRepository
{
    /**
     * Получить модель по первичному ключу
     * @param int $primary
     * @return Model|null
     */
    public function getByPrimary(int $primary): ?Model;

    public function getList(Q $query = null): Collection;

    public function createFromArray(array $data): Model;

    public function updateFromArray(Model $model, array $data): Model;

    public function remove(Model $model);
}
