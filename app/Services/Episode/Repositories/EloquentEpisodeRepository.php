<?php


namespace App\Services\Episode\Repositories;


use App\Models\Episode;
use App\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentEpisodeRepository implements EpisodeRepositoryInterface
{
    public function find(int $id): ?Episode
    {
        return Episode::find($id);
    }

    public function search(array $filters = [], User $user = null): LengthAwarePaginator
    {
        $builder = Episode::orderBy('no', 'desc')->where($filters);
        if ($user) {
            $builder->forUser($user);
        }
        return $builder->paginate();
    }

    public function createFromArray(array $data): Episode
    {
        return Episode::create($data);
    }

    public function updateFromArray(Episode $episode, array $data): Episode
    {
        $episode->update($data);
        return $episode;
    }

    public function delete(Episode $episode): void
    {
        $episode->delete();
    }
}
