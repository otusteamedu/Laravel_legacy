<?php

namespace App\Services\Tariffs\Repositories;

use App\Models\Tariff;

interface TariffRepositoryInterface
{

    public function find(int $id);

    public function search(array $filters = []);

    public function createFromArray(array $data): Tariff;

    public function updateFromArray(Tariff $tariff, array $data);

}
