<?php

namespace App\Services\Articles\Handlers;

use App\Models\Article;
use App\Services\Articles\Repositories\ArticleRepositoryInterface;

/**
 * Class DeleteArticleHandler
 * @package App\Services\Articles\Handlers
 */
class DeleteArticleHandler {
    private $articleRepository;

    public function __construct(
        ArticleRepositoryInterface $articleRepository
    )
    {
        $this->articleRepository = $articleRepository;
    }

    public function handle(Article $article): void
    {
        $article->delete();
    }
}
