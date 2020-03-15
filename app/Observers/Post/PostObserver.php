<?php

namespace App\Observers\Post;

use App\Models\Post\Post;
use App\Models\Post\Rubric;
use App\Services\Cache\CacheService;
use Illuminate\Support\Facades\Cache;

class PostObserver
{
    /**
     * @param Post $post
     */
    public function updated(Post $post): void
    {
        if (
            $post->is_published
            || ($post->getOriginal('published_at') !== $post->published_at)
        ) {
            $this->clearCache($post);
        }
    }

    /**
     * @param Post $post
     */
    public function deleted(Post $post): void
    {
        if ($post->is_published) {
            $this->clearCache($post);
            $this->clearCommentCache($post);
        }
    }

    /**
     * @param Post $post
     */
    protected function clearCache(Post $post): void
    {
        Cache::tags(CacheService::CACHE_TAGS['post'])
            ->forget(CacheService::CACHE_TAGS['lastList']);

        /** @var Rubric $rubric */
        foreach ($post->rubrics as $rubric) {
            Cache::tags([CacheService::CACHE_TAGS['post'], CacheService::CACHE_TAGS['rubric'], $rubric->id])
                ->flush();
        }

        Cache::tags([CacheService::CACHE_TAGS['post'], CacheService::CACHE_TAGS['all']])->flush();

        $cacheName = CacheService::makePageName($post->slug);
        Cache::tags([CacheService::CACHE_TAGS['post'], CacheService::CACHE_TAGS['view']])
            ->forget($cacheName);
    }

    /**
     * @param Post $post
     */
    protected function clearCommentCache(Post $post): void
    {
        $cacheName = CacheService::makeListName(['post' => $post->id]);
        Cache::tags([CacheService::CACHE_TAGS['post'], CacheService::CACHE_TAGS['comment']])
            ->forget($cacheName);
    }
}
