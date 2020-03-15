<?php


namespace App\Services\Portal\Menu;


use App\Models\Page\Page;
use App\Repositories\Page\PageRepositoryInterface;
use App\Services\Cache\CacheService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Lavary\Menu\Menu;

final class PageMenuService extends AbstractMenuService
{
    /** @var string $menuName */
    protected $menuName = 'pageMenu';

    /** @var PageRepositoryInterface $pageRepository */
    private $pageRepository;

    public function __construct(Menu $menu, Request $request, PageRepositoryInterface $pageRepository)
    {
        $this->pageRepository = $pageRepository;

        parent::__construct($menu, $request);
    }

    /**
     * @return array
     */
    protected function getTree(): array
    {
        return Cache::tags([CacheService::CACHE_TAGS['menu']])
            ->remember(
                CacheService::CACHE_TAGS['menu'],
                CacheService::CACHE_TTL['menu'],
                function () {
                    return $this->pageList();
                }
            );
    }

    /**
     * @return array
     */
    protected function pageList(): array
    {
        $pageCollection = $this->pageRepository->list([
                              'select' => ['name', 'slug'],
                              'order' => ['column' => 'name', 'order' => 'asc']
                          ]);

        $list = [];

        /** @var Page $page */
        foreach ($pageCollection as $page) {
            $list[] = [
                'name' => $page->name,
                'url' => route('portal.page', ['slug' => $page->slug]),
                'class' => 'nav-item',
            ];
        }

        return $list;
    }
}