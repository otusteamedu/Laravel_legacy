<?php


namespace App\Services\Constructions\Repositories;

use App\Models\Construction;
use Illuminate\Database\Eloquent\Builder;

interface ConstructionRepositoryInterface
{
    function getAllConstruction();
}
