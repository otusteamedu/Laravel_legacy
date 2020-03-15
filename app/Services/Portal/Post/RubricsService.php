<?php


namespace App\Services\Portal\Post;


use App\Models\Post\Rubric;
use App\Repositories\Post\Rubric\RubricRepositoryInterface;
use App\Services\Cache\CacheService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RubricsService
{
    /** @var RubricRepositoryInterface $rubricRepository */
    protected $rubricRepository;

    /**
     * RubricsService constructor.
     * @param RubricRepositoryInterface $rubricRepository
     */
    public function __construct(RubricRepositoryInterface $rubricRepository)
    {
        $this->rubricRepository = $rubricRepository;
    }

    /**
     * @param Request $request
     * @return Rubric
     */
    public function getRubric(Request $request): Rubric
    {
        $slug = $request->route('rubric');

        $cacheName = CacheService::makePageName($slug);

        return Cache::tags([CacheService::CACHE_TAGS['rubric']])
            ->remember(
                $cacheName,
                CacheService::CACHE_TTL['rubric'],
                function () use ($slug) {
                    return $this->rubricRepository->getBySlug($slug);
                }
            );
    }
}