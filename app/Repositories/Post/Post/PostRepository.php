<?php


namespace App\Repositories\Post\Post;


use App\Models\Post\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use InvalidArgumentException;

class PostRepository implements PostRepositoryInterface
{
    /** @inheritDoc */
    public function all(): Collection
    {
        return Post::all();
    }

    /** @inheritDoc */
    public function paginationList(array $options = []): LengthAwarePaginator
    {
        if (isset($options['limit'])) {
            $limit = $options['limit'];
            unset($options['limit']);
        }
        $query = $this->buildQuery($options);
        return $query->paginate($limit ?? null);
    }

    /** @inheritDoc */
    public function list(array $options = []): Collection
    {
        $query = $this->buildQuery($options);
        return $query->get();
    }

    /**
     * @param array $options
     * @return Builder
     */
    protected function buildQuery(array $options): Builder
    {
        $query = Post::query();
        foreach ($options as $key=>$value) {
            switch ($key) {
                case 'select':
                    $query->select($value);
                    break;
                case 'with':
                    $query->with($value);
                    break;
                case 'where':
                    $query = $this->buildWhere($query, $value);
                    break;
                case 'order':
                    $query->orderBy($value['column'], $value['order']);
                    break;
                case 'limit':
                    $query->limit((int) $value);
                    break;
            }
        }
        return $query;
    }

    /**
     * @param Builder $query
     * @param array $value
     * @return Builder
     */
    protected function buildWhere(Builder $query, array $value): Builder
    {
        foreach ($value as $where) {
            switch ($where['action']) {
                case 'IN':
                    $query->whereIn($where['column'], $where['value']);
                    break;
                case 'NOT_IN':
                    $query->whereNotIn($where['column'], $where['value']);
                    break;
                case 'NULL':
                    $query->whereNull($where['column']);
                    break;
                case 'NOT_NULL':
                    $query->whereNotNull($where['column']);
                    break;
                case 'HAS':
                    $query->whereHas(
                        $where['relation'],
                        function (Builder $builder) use ($where) {
                            $this->buildWhere($builder, $where['where']);
                        }
                    );
                    break;
                default:
                    $query->where(
                        $where['column'],
                        $where['action'],
                        $where['value']
                    );
                    break;
            }
        }

        return $query;
    }

    /** @inheritDoc */
    public function find(int $id): Post
    {
        return Post::findOrFail($id);
    }

    /** @inheritDoc */
    public function getBySlug(string $slug): Post
    {
        if ($slug === '') {
            throw new InvalidArgumentException('Не передан обязательный параметр $slug');
        }

        return Post::where('slug', '=', $slug)
            ->with('user')
            ->firstOrFail();
    }

    /** @inheritDoc */
    public function createFromArray(array $data): Post
    {
        $rubrics = $data['rubrics'] ?? [];
        unset($data['rubrics']);

        $post = new Post($data);
        $post->saveOrFail($data);

        $post->rubrics()->attach($rubrics);

        return $post;
    }

    /** @inheritDoc */
    public function updateFromArray(Post $post, array $data): Post
    {
        $rubrics = $data['rubrics'] ?? [];
        unset($data['rubrics']);

        $post->update($data);

        $post->rubrics()->sync($rubrics);
        return $post;
    }

    /** @inheritDoc */
    public function publishedFromArray(Post $post, array $data): Post
    {
        $post->update($data);
        return $post;
    }

    /** @inheritDoc */
    public function delete(Post $post): void
    {
        $post->delete();
    }
}