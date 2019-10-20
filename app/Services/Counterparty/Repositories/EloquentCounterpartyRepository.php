<?php

namespace App\Services\Counterparty\Repositories;

use App\Models\Counterparty;
use App\Services\EloquentBaseRepository;

class EloquentCounterpartyRepository extends EloquentBaseRepository implements CounterpartyRepositoryInterface
{
    /**
     * @return string
     */
    protected function model()
    {
        return Counterparty::class;
    }
}
