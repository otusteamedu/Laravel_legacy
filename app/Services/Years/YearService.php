<?php

namespace App\Services\Years;

use App\Services\Years\Repositories\YearRepositoryInterface;

class YearService
{
    /** @var  YearRepositoryInterface*/
    protected $repository;

    /**
     * YearService constructor.
     * @param YearRepositoryInterface $repository
     */
    public function __construct(YearRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return array
     */
    public function educationYearSelectList(): array
    {
        return $this->repository->selectList()->toArray();
    }
}
