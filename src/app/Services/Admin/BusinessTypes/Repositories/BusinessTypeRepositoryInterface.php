<?php

namespace App\Services\Admin\BusinessTypes\Repositories;

use App\Models\BusinessType;
use App\Services\Admin\BusinessTypes\DTOs\BusinessTypeDTO;

interface BusinessTypeRepositoryInterface
{
    public function find(int $id): ?BusinessType;
    public function create(BusinessTypeDTO $DTO): ?BusinessType;
    public function get();
    public function search(array $filter = []);
}
