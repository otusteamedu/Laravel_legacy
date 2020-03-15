<?php

namespace App\Services\Portal\Page;

use App\Models\Page\Page;
use App\Repositories\Page\PageRepositoryInterface;
use App\Services\Cache\CacheService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PagesService
{
    /** @var PageRepositoryInterface $pageRepository */
    protected $pageRepository;

    public function __construct(PageRepositoryInterface $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    /**
     * @param Request $request
     * @return Page
     */
    public function getPage(Request $request): Page
    {
        $slug = $request->route('slug');

        $cacheName = CacheService::makePageName($slug);

        return Cache::tags([CacheService::CACHE_TAGS['page']])
            ->remember(
                $cacheName,
                CacheService::CACHE_TTL['view'],
                function () use ($slug)
                {
                    return $this->pageRepository->getBySlug($slug);
                }
            );
    }
}