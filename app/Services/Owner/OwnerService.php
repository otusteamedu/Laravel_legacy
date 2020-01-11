<?php


namespace App\Services\Owner;


use App\Services\Owner\Repositories\OwnerRepository;
use App\Services\SubCategory\SubCategoryService;

class OwnerService extends SubCategoryService
{
    /**
     * OwnerService constructor.
     * @param OwnerRepository $repository
     */
    public function __construct(OwnerRepository $repository)
    {
        parent::__construct($repository);
    }
}
