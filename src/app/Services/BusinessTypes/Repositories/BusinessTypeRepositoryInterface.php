<?php

namespace App\Services\BusinessTypes\Repositories;

use App\Models\BusinessType;
use App\Services\BusinessTypes\DTOs\BusinessTypeDTO;

interface BusinessTypeRepositoryInterface
{
    public function get();
}
