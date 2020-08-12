<?php

namespace App\Services\Records\Repositories;

use App\Models\Record;
use Illuminate\Database\Eloquent\Collection;

interface RecordRepositoryInterface
{
    /**
     * Найти запись по ID
     * @param int $id
     * @return Record|null
     */
    public function find(int $id): ?Record;

    /**
     * Найти записи по Business ID
     * @param int $business_id
     * @return Collection|null
     */
    public function findByBusinessId(int $business_id): ?Collection;
}
