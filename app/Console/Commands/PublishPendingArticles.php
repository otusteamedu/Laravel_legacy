<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Services\ArticlesService;
use Carbon\Carbon;
use Illuminate\Console\Command;

/**
 * Class PublishPendingArticles
 * @package App\Console\Commands
 */
class PublishPendingArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'articles:publish-pending-items';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change the status of articles awaiting publication to published';


    protected $articlesService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ArticlesService $articlesService)
    {
        parent::__construct();
        $this->articlesService = $articlesService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $articles = $this->articlesService->getPendingItems();

        foreach ($articles as $article) {
            if ($article->published_at <= Carbon::now()) {
                $result = $this->articlesService->publishArticle($article);
                if ($result) {
                    $this->info(sprintf('Наступление даты публикации статьи id:%d. Статус изменен на "Опубликована"', $article->id));
                }
            }
        }
    }
}
