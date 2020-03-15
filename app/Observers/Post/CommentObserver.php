<?php

namespace App\Observers\Post;

use App\Models\Post\Comment;
use App\Services\Cache\CacheService;
use Illuminate\Support\Facades\Cache;

class CommentObserver
{
    /**
     * @param Comment $comment
     */
    public function updated(Comment $comment): void
    {
        if (
            $comment->is_published
            || ($comment->getOriginal('published_at') !== $comment->published_at)
        ) {
            $this->clearCache($comment);
        }
    }

    /**
     * @param Comment $comment
     */
    public function deleted(Comment $comment): void
    {
        if ($comment->is_published) {
            $this->clearCache($comment);
        }
    }

    /**
     * @param Comment $comment
     */
    protected function clearCache(Comment $comment): void
    {
        $cacheName = CacheService::makeListName(['post' => $comment->post_id]);
        Cache::tags([CacheService::CACHE_TAGS['post'], CacheService::CACHE_TAGS['comment']])
            ->forget($cacheName);
    }
}
