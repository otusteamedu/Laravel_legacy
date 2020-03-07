<?php

namespace App\Services\Articles\Repositories;

use App\Models\Article;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder ;

/**
 * Class EloquentArticleRepository
 * @package App\Services\Articles\Repositories
 */
class EloquentArticleRepository implements ArticleRepositoryInterface
{
    public function find(int $id)
    {
        return Article::find($id);
    }

    public function search(array $filters = []): LengthAwarePaginator
    {
        $article = Article::query();
        $this->applyFilters($article, $filters);

        return $article->paginate();
    }

    public function createFromArray(array $data): Article
    {
        $article = new Article();

        try {
            $article->fill($data)->save();
        } catch (\Throwable $exception) {
            return 'Произошла ошибка при сохранении:'
                . $exception->getMessage();
        }

        return $article;
    }

    public function updateFromArray(Article $article, array $data)
    {
        $article->update($data);

        return $article;
    }

    public function delete(int $id) {

    }

    /**
     * @param Builder $queryBuilder
     * @param array $filters
     */
    private function applyFilters(Builder $queryBuilder, array $filters) {

        if (isset($filters['name'])) {
            $queryBuilder->where('name', $filters['name']);
        }
    }
}
