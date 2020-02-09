<?php


namespace App\Repositories\Post\Post;


use App\Models\Post\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

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
        $query = $this->buildQuery($options);
        return $query->paginate();
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
                case 'with':
                    $query->with($value);
                    break;
                case 'order':
                    $query->orderBy($value['column'], $value['order']);
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