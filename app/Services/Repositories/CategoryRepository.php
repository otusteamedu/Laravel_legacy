<?php

namespace App\Services\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CategoryRepository
{
    /**
     * @param $id
     * @return Category|null
     */
    public function find($id)
    {
        return Category::find($id);
    }

    /**
     * @param array $columns
     * @return Category[]|Collection
     */
    public function getAll(array $columns = ['*'])
    {
        return Category::all($columns);
    }


    /**
     * @param array|null $options
     * @return LengthAwarePaginator
     */
    public function paginated(array $options = null)
    {
        return Category::paginate();
    }

    /**
     * @param array|null $options
     * @return array
     */
    public function getList(array $options = null)
    {
        $categories = Category::all(['id', 'title']);
        $categoryList = [];
        foreach ($categories as $category) {
            $categoryList[$category->id] = $category->title;
        }
        return $categoryList;
    }

    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @param int|null $limit
     * @param int|null $offset
     *
     * @return Category[]|Collection|null
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
     * @return Category|null
     */
    public function findOneBy(array $criteria, array $orderBy = null)
    {
        //
    }

    /**
     * @param array $data
     * @return Category|Model
     */
    public function createFromArray(array $data)
    {
        return Category::create($data);
    }

    /**
     * @param Category $category
     * @param array $data
     * @return Category|Model
     */
    public function updateFromArray(Category $category, array $data)
    {
        $category->update($data);

        return $category;
    }

    /**
     * @param Category $category
     * @param array|null $options
     * @return bool|null
     * @throws \Exception
     */
    public function delete(Category $category, array $options = null)
    {
        return $category->delete();
    }
}
