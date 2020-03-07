<?php

namespace App\Services\Articles\Handlers;

use App\Models\Article;
use App\Services\Articles\Repositories\ArticleRepositoryInterface;
use Carbon\Carbon;

/**
 * Class CreateArticleHandler
 * @package App\Services\Articles\Handlers
 */
class CreateArticleHandler {
    private $articleRepository;

    public function __construct(
        ArticleRepositoryInterface $articleRepository
    )
    {
        $this->articleRepository = $articleRepository;
    }

    public function handle(array $data): Article
    {
        $data['created_at'] = Carbon::create()->subDay();
        $data['name'] = ucfirst($data['name']);
        $data['description'] = trim($data['description']);

        return $this->articleRepository->createFromArray($data);
    }
}
