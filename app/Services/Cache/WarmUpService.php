<?php

namespace App\Services\Cache;

use App\Models\Page\Page;
use App\Models\Post\Post;
use App\Models\Post\Rubric;
use App\Repositories\Page\PageRepositoryInterface;
use App\Repositories\Post\Comment\CommentRepositoryInterface;
use App\Repositories\Post\Post\PostRepositoryInterface;
use App\Repositories\Post\Rubric\RubricRepositoryInterface;
use App\Services\Image\Image;
use App\Services\Portal\Post\PostsService;
use Illuminate\Support\Facades\Cache;

/**
 * Class WarmUpService
 * @package App\Services\Cache
 */
class WarmUpService
{
    use Image;

    /** @var PageRepositoryInterface  */
    protected $pageRepository;

    /** @var RubricRepositoryInterface  */
    protected $rubricRepository;

    /** @var PostRepositoryInterface  */
    protected $postRepository;

    /**
     * WarmUpService constructor.
     * @param PageRepositoryInterface $pageRepository
     * @param RubricRepositoryInterface $rubricRepository
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(
        PageRepositoryInterface $pageRepository,
        RubricRepositoryInterface $rubricRepository,
        PostRepositoryInterface $postRepository
    )
    {
        $this->pageRepository = $pageRepository;
        $this->rubricRepository = $rubricRepository;
        $this->postRepository = $postRepository;
    }

    protected $modules = [
        'page',
        'rubric',
        'post',
    ];

    /**
     * @param array $modules
     * @param int $sleep
     */
    public function upCache(array $modules, int $sleep): void
    {
        $warmModules = empty($modules)
            ? $this->modules
            : array_intersect(array_keys($this->modules), $modules);
        foreach ($warmModules as $module) {
            switch ($module) {
                case 'page':
                    $this->pageWarm();
                    break;
                case 'rubric':
                    $this->rubricWarm();
                    break;
                case 'post':
                    $this->postWarm();
                    break;
            }
            sleep($sleep * 10);
        }
    }

    /**
     * Прогреваем кеш страниц
     */
    protected function pageWarm(): void
    {
        $pages = $this->pageRepository->all();

        /** @var Page $page */
        foreach ($pages as $page) {
            $cacheName = CacheService::makePageName($page->slug);
            Cache::tags([CacheService::CACHE_TAGS['page']])
                ->put($cacheName, $page, CacheService::CACHE_TTL['view']);
        }
    }

    /**
     * Прогреваем кеш рубрики
     */
    protected function rubricWarm(): void
    {
        $rubrics = $this->rubricRepository->all();

        /** @var Rubric $rubric */
        foreach ($rubrics as $rubric) {
            $cacheName = CacheService::makePageName($rubric->slug);
            Cache::tags([CacheService::CACHE_TAGS['rubric']])
                ->put($cacheName, $rubric, CacheService::CACHE_TTL['rubric']);
        }
    }

    /**
     * Прогреваем кеш публикаций
     */
    protected function postWarm(): void
    {
        $posts = $this->postRepository->list([
            'where' => [
                [
                    'column' => 'published_at',
                    'action' => 'NOT_NULL',
                ]
            ]
        ]);

        /** @var Post $post */
        foreach ($posts as $post) {
            $cacheName = CacheService::makePageName($post->slug);

            if ($post->image !== null) {
                $post->image = $this->getImage(
                    $post->id,
                    Post::IMAGE_PATH,
                    $post->image,
                    PostsService::MEDIUM_IMAGE
                );
            }

            Cache::tags([CacheService::CACHE_TAGS['post'], CacheService::CACHE_TAGS['view']])
                ->put($cacheName, $post, CacheService::CACHE_TTL['view']);
        }
    }
}