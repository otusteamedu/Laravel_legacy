<?php

namespace App\Services\Episode;

use App\Models\Episode;
use App\Services\Episode\Repositories\EpisodeRepositoryInterface;
use App\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;

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
    public function searchEpisodes(array $filters = [], User $user = null): LengthAwarePaginator
    {
        return $this->episodeRepository->search($filters, $user);
    }

    /**
     * @param array $data
     * @return Episode
     */
    public function storeEpisode(array $data): Episode
    {
        $episode = $this->episodeRepository->createFromArray($data);

        if (!empty($data['cover'])) {
            $this->handleCoverUpload($episode, $data['cover']);
        }

        return $episode;
    }

    /**
     * @param Episode $episode
     * @param array $data
     * @return void
     */
    public function updateEpisode(Episode $episode, array $data): void
    {
        $this->episodeRepository->updateFromArray($episode, $data);

        if (!empty($data['cover'])) {
            $this->handleCoverUpload($episode, $data['cover']);
        }
    }

    public function deleteEpisode(Episode $podcast): void
    {
        $this->episodeRepository->delete($podcast);
    }

    /**
     * @param Episode $episode
     * @param UploadedFile $file
     * @return void
     */
    public function handleCoverUpload(Episode $episode, UploadedFile $file): void
    {
        $filepath = $file->store('public/' . config('podcast-publisher.episodes_cover_public_dir'));
        $this->episodeRepository->updateFromArray($episode, ['cover_file' => $filepath]);
    }
}
