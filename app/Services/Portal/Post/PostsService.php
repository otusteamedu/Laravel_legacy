<?php

namespace App\Services\Portal\Post;

use App\Models\Post\Post;
use App\Repositories\Post\Post\PostRepositoryInterface;
use App\Services\Cache\CacheService;
use App\Services\Image\Image;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class PostsService
{
    use Image;

    /** @var int  */
    protected const LIST_COUNT = 4;

    /** @var string  */
    public const SMALL_IMAGE = 'small';

    /** @var string  */
    public const MEDIUM_IMAGE = 'medium';

    /** @var PostRepositoryInterface $postRepository */
    protected $postRepository;

    /** @var array  */
    protected $requestParams = [];

    /** @var string[]  */
    protected const SELECT_LIST_FIELDS = [
        'id',
        'name',
        'slug',
        'image',
        'created_at',
    ];

    /** @var string[]  */
    protected const ORDER_LIST = [
        'column' => 'created_at',
        'order' => 'asc'
    ];

    /** @var string[]  */
    protected const WHERE_VIEW = [
        'column' => 'published_at',
        'action' => 'NOT_NULL',
    ];

    /**
     * PostsService constructor.
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @return Collection
     */
    public function getLastList(): Collection
    {
        return Cache::tags(CacheService::CACHE_TAGS['post'])
            ->remember(
                CacheService::CACHE_TAGS['lastList'],
                CacheService::CACHE_TTL['lastList'],
                function () {
                    $postCollection = $this->postRepository->list([
                                        'select' => self::SELECT_LIST_FIELDS,
                                        'where' => [
                                            self::WHERE_VIEW,
                                        ],
                                        'order' => self::ORDER_LIST,
                                        'limit' => self::LIST_COUNT,
                                    ]);
                    return $this->preparePostCollection($postCollection);
                }
            );
    }

    /**
     * @param Request $request
     * @param int $rubricId
     * @return LengthAwarePaginator
     */
    public function getRubricList(Request $request, int $rubricId): LengthAwarePaginator
    {
        $this->requestParams = $request->only(['page']);

        $this->requestParams['rubric'] = $rubricId;

        $cacheName = CacheService::makeListName($this->requestParams);

        return Cache::tags([CacheService::CACHE_TAGS['post'], CacheService::CACHE_TAGS['rubric'], $rubricId])
            ->remember(
                $cacheName,
                CacheService::CACHE_TTL['rubric'],
                function () {
                    $postList = $this->postRepository->paginationList([
                                  'select' => self::SELECT_LIST_FIELDS,
                                  'with' => 'rubrics',
                                  'where' => [
                                      self::WHERE_VIEW,
                                      [
                                          'action' => 'HAS',
                                          'relation' => 'rubrics',
                                          'where' => [
                                              [
                                                  'action' => '=',
                                                  'column' => 'rubric_id',
                                                  'value' => $this->requestParams['rubric'],
                                              ],
                                          ],
                                      ]
                                  ],
                                  'order' => self::ORDER_LIST,
                                  'limit' => self::LIST_COUNT,
                              ]);

                    return $postList->appends(
                        'items',
                        $this->preparePostCollection(collect($postList->items()))
                    );
                }
            );
    }

    /**
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPostList(Request $request): LengthAwarePaginator
    {
        $this->requestParams = $request->only(['page']);

        $cacheName = CacheService::makeListName($this->requestParams);

        return Cache::tags([CacheService::CACHE_TAGS['post'], CacheService::CACHE_TAGS['all']])
            ->remember(
                $cacheName,
                CacheService::CACHE_TTL['lastList'],
                function () {
                    $postList = $this->postRepository->paginationList([
                                  'select' => self::SELECT_LIST_FIELDS,
                                  'where' => [
                                      self::WHERE_VIEW,
                                  ],
                                  'order' => self::ORDER_LIST,
                                  'limit' => self::LIST_COUNT,
                              ]);

                    return $postList->appends('items', $this->preparePostCollection(collect($postList->items())));
                }
            );
    }

    /**
     * @param Collection $postCollection
     * @return Collection
     */
    protected function preparePostCollection(Collection $postCollection): Collection
    {
        /** @var Post $post */
        foreach ($postCollection as &$post) {
            $post->link = route('portal.post.view', [
                'slug' => $post->slug,
            ]);

            if ($post->image !== null) {
                $post->image = $this->getImage($post->id, Post::IMAGE_PATH, $post->image, self::SMALL_IMAGE);
            }
        }

        return $postCollection;
    }

    /**
     * @param Request $request
     * @return Post
     */
    public function getPost(Request $request): Post
    {
        $slug = $request->route('slug');

        $cacheName = CacheService::makePageName($slug);

        return Cache::tags([CacheService::CACHE_TAGS['post'], CacheService::CACHE_TAGS['view']])
            ->remember(
                $cacheName,
                CacheService::CACHE_TTL['view'],
                function () use ($slug) {
                    $post = $this->postRepository->getBySlug($slug);

                    if ($post->image !== null) {
                        $post->image = $this->getImage(
                            $post->id,
                            Post::IMAGE_PATH,
                            $post->image,
                            self::MEDIUM_IMAGE
                        );
                    }

                    return $post;
                }
            );
    }
}