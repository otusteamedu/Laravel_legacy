<?php


namespace App\Services\Filters\Handlers;


use App\Models\Filter;
use App\Services\Filters\Repositories\FilterRepositoryInterface;

class UpdateFilterHandler
{
    /**
     * @var FilterRepositoryInterface
     */
    private FilterRepositoryInterface $filterRepository;

    public function __construct(
        FilterRepositoryInterface $filterRepository
    )
    {
        $this->filterRepository = $filterRepository;
    }

    public function handle(Filter $filter, array $data)
    {
       return $this->filterRepository->updateFromArray($filter, $data);
    }
}
