<?php

namespace App\Services;

use App\Services\Repositories\ArticleRepository;
use App\Models\Article;
use Illuminate\Database\Eloquent\Collection;

class ArticlesService
{
    private $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
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
        return $this->articleRepository->paginated($options);
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

}
