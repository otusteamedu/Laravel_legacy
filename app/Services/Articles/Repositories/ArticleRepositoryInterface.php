<?php

namespace App\Services\Articles\Repositories;

use App\Models\Article;

/**
 * Interface ArticleRepositoryInterface
 * @package App\Services\Articles\Repositories
 */
interface ArticleRepositoryInterface
{
    public function find(int $id);

    public function search(array $filters = []);

    public function createFromArray(array $data): Article;

    public function updateFromArray(Article $article, array $data);

    public function delete(int $id);
}
