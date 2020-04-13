<?php


namespace App\Services\Filters;


use App\Models\Filter;
use App\Services\Filters\Handlers\CreateFilterHandler;
use App\Services\Filters\Handlers\UpdateFilterHandler;
use App\Services\Filters\Repositories\FilterRepositoryInterface;
use App\Services\FilterTypes\Repositories\FilterTypeRepositoryInterface;

class FiltersService
{

    /**
     * @var FilterRepositoryInterface
     */
    private FilterRepositoryInterface $filterRepository;
    /**
     * @var FilterTypeRepositoryInterface
     */
    private FilterTypeRepositoryInterface $filterTypeRepository;
    /**
     * @var CreateFilterHandler
     */
    private CreateFilterHandler $createFilterHandler;

    private UpdateFilterHandler $updateFilterHandler;

    public function __construct(
        FilterRepositoryInterface $filterRepository,
        FilterTypeRepositoryInterface $filterTypeRepository,
        CreateFilterHandler $createFilterHandler,
        UpdateFilterHandler $updateFilterHandler
    )
    {
        $this->filterRepository = $filterRepository;
//        $this->filterTypeRepository = $filterTypeRepository;
        $this->createFilterHandler = $createFilterHandler;
        $this->updateFilterHandler = $updateFilterHandler;
    }

    public function search(array $filters)
    {
        return $this->filterRepository->search($filters);
    }

    public function create(array $data)
    {
        return $this->createFilterHandler->handle($data);
    }

    public function update(Filter $model, array $data)
    {
        $this->updateFilterHandler->handle($model, $data);
    }

}
