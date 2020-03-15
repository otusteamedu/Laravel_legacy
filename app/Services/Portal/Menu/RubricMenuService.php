<?php


namespace App\Services\Portal\Menu;


use App\Models\Post\Rubric;
use App\Repositories\Post\Rubric\RubricRepositoryInterface;
use App\Services\Cache\CacheService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Lavary\Menu\Menu;

final class RubricMenuService extends AbstractMenuService
{
    protected $menuName = 'rubricMenu';

    /** @var RubricRepositoryInterface $rubricRepository */
    private $rubricRepository;

    /**
     * RubricMenuService constructor.
     * @param Menu $menu
     * @param Request $request
     * @param RubricRepositoryInterface $rubricRepository
     */
    public function __construct(Menu $menu, Request $request, RubricRepositoryInterface $rubricRepository)
    {
        $this->rubricRepository = $rubricRepository;

        parent::__construct($menu, $request);
    }


    /**
     * @return array
     */
    protected function getTree(): array
    {
        return Cache::tags([CacheService::CACHE_TAGS['menu']])
                ->remember(
                    CacheService::CACHE_TAGS['rubric'],
                    CacheService::CACHE_TTL['menu'],
                    function () {
                        return $this->rubricList();
                    }
                );
    }

    /**
     * @return array
     */
    protected function rubricList(): array
    {
        $rubricCollection = $this->rubricRepository->list([
                              'select' => ['name', 'slug', 'id'],
                              'order' => ['column' => 'name', 'order' => 'asc'],
                              'with' => 'posts',
                          ]);

        $list = [];

        /** @var Rubric $rubric */
        foreach ($rubricCollection as $rubric) {

            $postCount = $rubric->posts
                ->whereNotNull('published_at')
                ->count();

            if ($postCount > 0) {
                $list[] = [
                    'name' => $rubric->name,
                    'url' => route('portal.post.rubric.list', ['rubric' => $rubric->slug]),
                ];
            }
        }

        return $list;
    }
}