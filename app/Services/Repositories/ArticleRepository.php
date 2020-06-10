<?php

namespace App\Services\Repositories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ArticleRepository
{
    /**
     * @param $id
     * @return Article|null
     */
    public function find($id)
    {
        return Article::find($id);
    }

    /**
     * @param array $columns
     * @return Article[]|Collection
     */
    public function getAll(array $columns = ['*'])
    {
        return Article::all($columns);
    }

    /**
     * @param array|null $options
     * @return LengthAwarePaginator
     */
    public function paginated(array $options = null)
    {
        return Article::paginate();
    }

    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @param int|null $limit
     * @param int|null $offset
     *
     * @return Article[]|Collection|null
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        //
    }

    /**
     * Finds a single entity by a set of criteria.
     *
     * @param array $criteria
     * @param array|null $orderBy
     *
     * @return Article|null
     */
    public function findOneBy(array $criteria, array $orderBy = null)
    {
        //
    }

    /**
     * @param array $data
     * @return Article|Model
     */
    public function createFromArray(array $data)
    {
        return Article::create($data);
    }

    /**
     * @param Article $article
     * @param array $data
     * @return Article|Model
     */
    public function updateFromArray(Article $article, array $data)
    {
        $article->update($data);

        return $article;
    }

    /**
     * @param Article $article
     * @param array|null $options
     * @return bool|null
     * @throws \Exception
     */
    public function delete(Article $article, array $options = null)
    {
        return $article->delete();
    }
}
