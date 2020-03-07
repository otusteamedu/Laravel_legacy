<?php

namespace App\Services\Articles\Handlers;

use App\Models\Article;
use App\Services\Articles\Repositories\ArticleRepositoryInterface;
use App\Services\Articles\Repositories\EloquentArticleRepository;

/**
 * Class UpdateArticleHandler
 * @package App\Services\Articles\Handlers
 */
class UpdateArticleHandler {
    private $articleRepository;

    public function __construct(
        ArticleRepositoryInterface $articleRepository
    )
    {
        $this->articleRepository = $articleRepository;
    }

    public function handle(Article $article, array $data): Article
    {
        if (isset($data['name'])) {
            $data['name'] = ucfirst($data['name']);
        }

        if (isset($data['description'])) {
            $data['description'] = trim($data['description']);
        }

        return $this->articleRepository->updateFromArray($article, $data);
    }
}
