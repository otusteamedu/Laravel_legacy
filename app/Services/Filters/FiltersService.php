<?php


namespace App\Services\Filters;


use App\Jobs\FilterProcess;
use App\Jobs\Queue;
use App\Models\Filter;
use App\Services\Filters\Handlers\CreateFilterHandler;
use App\Services\Filters\Handlers\UpdateFilterHandler;
use App\Services\Filters\Repositories\CachedFilterRepositoryInterface;
use App\Services\Filters\Repositories\FilterRepositoryInterface;
use App\Services\FilterTypes\Repositories\FilterTypeRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

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
    /**
     * @var CachedFilterRepositoryInterface
     */
    private CachedFilterRepositoryInterface $cashedFilterRepository;

    public function __construct(
        FilterRepositoryInterface $filterRepository,
        FilterTypeRepositoryInterface $filterTypeRepository,
        CreateFilterHandler $createFilterHandler,
        UpdateFilterHandler $updateFilterHandler,
        CachedFilterRepositoryInterface $cashedFilterRepository
    )
    {
        $this->filterRepository = $filterRepository;
//        $this->filterTypeRepository = $filterTypeRepository;
        $this->createFilterHandler = $createFilterHandler;
        $this->updateFilterHandler = $updateFilterHandler;
        $this->cashedFilterRepository = $cashedFilterRepository;
    }

    public function searchCachedFiltersWithFilterTypes($filters): LengthAwarePaginator
    {
        return $this->cashedFilterRepository->search($filters);
    }

    public function searchFiltersWithFilterTypes($filters): LengthAwarePaginator
    {
        return $this->filterRepository->search($filters);
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
        return $this->updateFilterHandler->handle($model, $data);
    }

    public function createInQueue(array $data)
    {
        FilterProcess::dispatch($data)
            ->delay(now()->addSecond(5))
            ->onQueue(Queue::HIGH);
        return new Filter();  // Just for test
    }

    public function getAll()
    {
       return $this->cashedFilterRepository->getBy();
    }

}
