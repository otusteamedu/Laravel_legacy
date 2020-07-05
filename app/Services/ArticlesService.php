<?php

namespace App\Services;

use App\Services\Repositories\ArticleCacheRepository;
use App\Services\Repositories\ArticleRepository;
use App\Models\Article;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ArticlesService
 * @package App\Services
 */
class ArticlesService
{
    /**
     * @var ArticleRepository
     */
    private $articleRepository;

    /**
     * @var ArticleCacheRepository
     */
    private $articleCacheRepository;

    /**
     * ArticlesService constructor.
     * @param ArticleRepository $articleRepository
     * @param ArticleCacheRepository $articleCacheRepository
     */
    public function __construct(ArticleRepository $articleRepository, ArticleCacheRepository $articleCacheRepository)
    {
        $this->articleRepository = $articleRepository;
        $this->articleCacheRepository = $articleCacheRepository;
    }

    /**
     * @param array|null $options
     * @return Article[]|Collection
     */
    public function all(array $options = null)
    {
        return $this->articleRepository->getAll($options);
    }

    /**
     * @param array|null $options
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function allPaginated(array $options = null)
    {
        return $this->articleCacheRepository->paginated($options);
    }

    /**
     * @param array $data
     * @return Article
     */
    public function createArticle(array $data)
    {
        $data['state'] = 1;

        return $this->articleRepository->createFromArray($data);
    }

    /**
     * @param Article $article
     * @param array $data
     * @return Article
     */
    public function updateArticle(Article $article, array $data)
    {
        return $this->articleRepository->updateFromArray($article, $data);
    }

    /**
     * @param Article $article
     * @param array|null $options
     * @return bool|null
     * @throws \Exception
     */
    public function deleteArticle(Article $article, array $options = null)
    {
        return $this->articleRepository->delete($article);
    }

    /**
     * Очистка кэша
     */
    public function clearCache()
    {
        $this->articleCacheRepository->clear();
    }

}
