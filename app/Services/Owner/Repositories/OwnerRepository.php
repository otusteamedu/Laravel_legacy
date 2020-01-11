<?php


namespace App\Services\Owner\Repositories;

use App\Models\Owner;
use App\Services\SubCategory\Repositories\SubCategoryRepository;

class OwnerRepository extends SubCategoryRepository
{
    /**
     * OwnerRepository constructor.
     * @param Owner $model
     */
    public function __construct(Owner $model)
    {
        $this->model = $model;
    }
}
