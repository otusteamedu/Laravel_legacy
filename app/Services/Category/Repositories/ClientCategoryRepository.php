<?php


namespace App\Services\Category\Repositories;


use App\Models\Category;
use App\Services\Base\Resource\Repositories\ClientBaseResourceRepository;
use Illuminate\Database\Eloquent\Collection;

class ClientCategoryRepository extends ClientBaseResourceRepository
{
    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    /**
     * @return Collection
     */
    public function index(): Collection {
        return $this->model::select(['id', 'type', 'title', 'alias', 'image_path'])
            ->where('publish', 1)
            ->get();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id)
    {
        return $this->model::findOrFail($id);
    }

    /**
     * @param string $alias
     * @return mixed
     */
    public function getItemByAlias(string $alias)
    {
        return $this->model::where('alias', $alias)->firstOrFail();
    }

    /**
     * @param $category
     * @param array $pagination
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getImages($category, array $pagination)
    {
        return $category->images()
            ->where('publish', 1)
            ->select(['id', 'format_id', 'views'])
            ->withCount('likes')
            ->orderBy($pagination['sort_by'], $pagination['sort_order'])
            ->paginate($pagination['per_page'], ['*'], '', $pagination['current_page']);
    }
}
