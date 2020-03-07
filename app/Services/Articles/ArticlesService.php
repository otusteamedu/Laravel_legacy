<?php

namespace App\Services\Articles;


use App\Models\Article;
use App\Services\Articles\Handlers\CreateArticleHandler;
use App\Services\Articles\Handlers\UpdateArticleHandler;
use App\Services\Articles\Handlers\DeleteArticleHandler;
use App\Services\Articles\Repositories\ArticleRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ArticlesService
{
    private $createArticleHandler;
    private $updateArticleHandler;
    private $deleteArticleHandler;
    private $articleRepository;

    public function __construct(
        CreateArticleHandler $createArticleHandler,
        UpdateArticleHandler $updateArticleHandler,
        DeleteArticleHandler $deleteArticleHandler,
        ArticleRepositoryInterface $articleRepository
    )
    {
        $this->createArticleHandler = $createArticleHandler;
        $this->updateArticleHandler = $updateArticleHandler;
        $this->deleteArticleHandler = $deleteArticleHandler;
        $this->articleRepository = $articleRepository;
    }

    /**
     * @param int $id
     * @return Article|null
     */
    public function findArticle(int $id)
    {
        return $this->articleRepository->find($id);
    }

    /**
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function searchArticles(array $filters): LengthAwarePaginator
    {
        return $this->articleRepository->search($filters);
    }

    /**
     * @param array $data
     * @return Article
     */
    public function storeArticle(array $data): Article
    {
        return $this->createArticleHandler->handle($data);
    }

    /**
     * @param Article $article
     * @param array $data
     * @return Article
     */
    public function updateArticle(Article $article, array $data): Article
    {
        return $this->updateArticleHandler->handle($article, $data);
    }

    /**
     * @param Article $article
     */
    public function deleteArticle(Article $article) {
        return $this->deleteArticleHandler->handle($article);
    }
}
