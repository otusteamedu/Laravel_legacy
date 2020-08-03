<?php

namespace App\Services\Admin\Businesses\Repositories;

use App\Models\Business;
use App\Services\Admin\Businesses\DTOs\BusinessCreateDTO;

interface BusinessRepositoryInterface
{
    public function find(int $id): ?Business;
    public function create(BusinessCreateDTO $businessDTO): ?Business;
    public function update(Business $business): Business;
    public function get();
    public function search(array $filter = []);
    public function delete(Business $business): bool;
}
