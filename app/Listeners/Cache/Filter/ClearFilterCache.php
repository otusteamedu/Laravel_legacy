<?php


namespace App\Listeners\Cache\Filter;


use App\Services\Events\Models\Filter\FilterSaved;
use App\Services\Filters\Repositories\CachedFilterRepositoryInterface;
use Illuminate\Support\Facades\Log;

class ClearFilterCache
{

    /**
     * @var CachedFilterRepositoryInterface
     */
    private CachedFilterRepositoryInterface $cachedFilterRepository;

    public function __construct(CachedFilterRepositoryInterface $cachedFilterRepository )
    {

        $this->cachedFilterRepository = $cachedFilterRepository;
    }

    public function handle(FilterSaved $filterSaved)
    {
        $filter = $filterSaved->getFilter();

        /*if (config('app.env') === 'local') {
            Log::info('Cache Hit', [
                $filter->id,
                $filter->name,
                $filter->description,
            ]);
        }*/

        $this->cachedFilterRepository->clearFilterCache($filter);
    }

}
