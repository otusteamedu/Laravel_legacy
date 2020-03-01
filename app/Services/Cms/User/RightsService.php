<?php

namespace App\Services\Cms\User;

use App\Repositories\User\Right\RightRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class RightsService
 * @package App\Services\Cms\User
 */
class RightsService
{
    /** @var RightRepositoryInterface  */
    protected $rightRepository;

    /**
     * RightsService constructor.
     * @param RightRepositoryInterface $rightRepository
     */
    public function __construct(RightRepositoryInterface $rightRepository)
    {
        $this->rightRepository = $rightRepository;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function paginationList(): LengthAwarePaginator
    {
        return $this->rightRepository->paginationList([
                    'order' => ['column' => 'id', 'order' => 'asc'],
                ]);
    }

    /**
     * @return array
     */
    public function getArrayList(): array
    {
        return $this->rightRepository->arrayList([
                      'order' => ['column' => 'id', 'order' => 'asc'],
                  ]);
    }
}
