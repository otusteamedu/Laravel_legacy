<?php

namespace App\Services\Years;

use App\Services\Interfaces\CacheService;
use App\Services\Traits\CacheClearable;
use App\Services\Years\Repositories\YearRepositoryInterface;

/**
 * Class YearService
 * @package App\Services\Years
 */
class YearService implements CacheService
{
    use CacheClearable;

    const CACHE_TAG = 'EDUCATION_YEAR';

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

    public function cacheWarm(): void
    {
        $this->educationYearSelectList();
    }

    /**
     * Список вида [id => '2020-06-24 - 2021-06-23']
     * @return array
     */
    public function educationYearSelectList(): array
    {
        return $this->repository->selectList()->toArray();
    }
}
