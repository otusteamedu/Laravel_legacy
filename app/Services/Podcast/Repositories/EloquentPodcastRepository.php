<?php


namespace App\Services\Podcast\Repositories;


use App\Models\Podcast;
use App\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentPodcastRepository implements PodcastRepositoryInterface
{
    public function find(int $id): ?Podcast
    {
        return Podcast::find($id);
    }

    public function search(array $filters = [], User $user = null): LengthAwarePaginator
    {
        $builder = Podcast::with('latestEpisode')->orderBy('name')->where($filters);
        if ($user) {
            $builder->forUser($user);
        }
        return $builder->paginate();
    }

    public function createFromArray(array $data): Podcast
    {
        return Podcast::create($data);
    }

    public function updateFromArray(Podcast $podcast, array $data): Podcast
    {
        $podcast->update($data);
        return $podcast;
    }

    public function delete(Podcast $podcast): void
    {
        $podcast->delete();
    }

    /**
     * Возвращает массив подкастов в формате id => name
     * @return array
     */
    public function getPodcastsOptions(): array
    {
        $categories = \DB::select("SELECT id, name FROM podcasts ORDER BY name");
        return array_combine(array_column($categories, 'id'), array_column($categories, 'name'));
    }
}
