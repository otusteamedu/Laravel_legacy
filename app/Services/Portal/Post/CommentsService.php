<?php

namespace App\Services\Portal\Post;

use App\Collections\Comment\CommentCollection;
use App\Repositories\Post\Comment\CommentRepositoryInterface;
use App\Services\Cache\CacheService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

/**
 * Class CommentsService
 * @package App\Services\Portal\Post
 */
class CommentsService
{
    /** @var CommentRepositoryInterface $commentRepository */
    protected $commentRepository;

    /** @var array $requestParams */
    protected $requestParams = [];

    /** @var string[]  */
    protected const WHERE_VIEW = [
        'column' => 'published_at',
        'action' => 'NOT_NULL',
    ];

    /**
     * CommentsService constructor.
     * @param CommentRepositoryInterface $commentRepository
     */
    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * @param int $postId
     * @return Collection
     */
    public function getList(int $postId): Collection
    {
        $this->requestParams['post'] = $postId;

        $cacheName = CacheService::makeListName($this->requestParams);

        return Cache::tags([CacheService::CACHE_TAGS['post'], CacheService::CACHE_TAGS['comment']])
            ->remember(
                $cacheName,
                CacheService::CACHE_TTL['comment'],
                function () {
                    return $this->prepareComments();
                }
            );
    }

    /**
     * @return Collection
     */
    protected function prepareComments(): Collection
    {
        $comments = $this->commentRepository->list([
                       'with' => ['children', 'user'],
                       'where' => [
                           self::WHERE_VIEW,
                           [
                               'column' => 'post_id',
                               'action' => '=',
                               'value' => $this->requestParams['post'],
                           ]
                       ],
                       'order' => [
                           ['column' => 'id', 'order' => 'asc'],
                           ['column' => 'published_at', 'order' => 'desc'],
                       ],
                   ]);

        $commentCollection = new CommentCollection();

        if ($comments->count()) {
            foreach ($comments as $comment) {
                $commentCollection->add($comment);
            }

            $commentCollection = $commentCollection->threaded();
        }

        return $commentCollection;
    }
}