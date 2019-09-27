<?php

namespace App\Services\Episode;

use App\Models\Episode;
use App\Services\Episode\Repositories\EpisodeRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class EpisodeService
{
    /**
     * @var EpisodeRepositoryInterface
     */
    private $episodeRepository;

    /**
     * EpisodeService constructor.
     * @param EpisodeRepositoryInterface $podcastRepository
     */
    public function __construct(EpisodeRepositoryInterface $podcastRepository)
    {
        $this->episodeRepository = $podcastRepository;
    }

    /**
     * @param int $id
     * @return Episode|null
     */
    public function findEpisode(int $id): ?Episode
    {
        return $this->episodeRepository->find($id);
    }

    /**
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function searchEpisodes(array $filters = []): LengthAwarePaginator
    {
        return $this->episodeRepository->search($filters);
    }

    /**
     * @param array $data
     * @return Episode
     */
    public function storeEpisode(array $data): Episode
    {
        $episode = $this->episodeRepository->createFromArray($data);
        return $episode;
    }

    /**
     * @param Episode $podcast
     * @param array $data
     * @return Episode
     */
    public function updateEpisode(Episode $podcast, array $data): Episode
    {
        return $this->episodeRepository->updateFromArray($podcast, $data);
    }

    public function deleteEpisode(Episode $podcast): void
    {
        $this->episodeRepository->delete($podcast);
    }

    /**
     * @param Request $request
     * @param Episode $episode
     * @return bool
     */
    public function handleCoverUpload(Request $request, Episode $episode): bool
    {
        $file = $request->file('cover');
        if (!$file) {
            return false;
        }

        $filepath = $file->store('public/episodes');
        $this->episodeRepository->updateFromArray($episode, ['cover_file' => $filepath]);
        return true;
    }
}
