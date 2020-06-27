<?php

namespace App\Observers;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Services\ArticlesService;

/**
 * Class ArticleObserver
 * @package App\Observers
 */
class ArticleObserver
{
    /**
     * @var ArticlesService
     */
    private $articlesService;

    public function __construct(ArticlesService $articlesService)
    {
        $this->$articlesService = $articlesService;
    }

    /**
     * Handle the article "created" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function created(Article $article)
    {
        $this->articlesService->clearCache();
    }

    /**
     * Handle the article "updated" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function updated(Article $article)
    {
        $this->articlesService->clearCache();
    }

    /**
     * Handle the article "deleted" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function deleted(Article $article)
    {
        $this->articlesService->clearCache();
    }

    /**
     * Handle the article "restored" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function restored(Article $article)
    {
        $this->articlesService->clearCache();
    }

    /**
     * Handle the article "force deleted" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function forceDeleted(Article $article)
    {
        $this->articlesService->clearCache();
    }
}
