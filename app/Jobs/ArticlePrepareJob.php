<?php

namespace App\Jobs;

use App\Models\Article;
use App\Services\ArticlesService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Подготовка статьи к публикации
 *
 * Class PrepareJob
 * @package App\Jobs
 */
class ArticlePrepareJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $message;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Article $article)
    {
        $this->message = $article;
    }

    /**
     * Execute the job.
     *
     * @param ArticlesService $articlesService
     * @return void
     */
    public function handle(ArticlesService $articlesService)
    {
        echo 'Prepare...';
        $articlesService->prepareForPublication($this->message);
        $articlesService->publishArticle($this->message, true);
        \Log::channel('processlog')->info(sprintf('Cтатья[id-%d] подготовлена к публикации', $this->message->id));
    }
}
