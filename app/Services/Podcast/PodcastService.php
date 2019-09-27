<?php

namespace App\Services\Podcast;

use App\Models\Podcast;
use App\Services\Podcast\Repositories\PodcastRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class PodcastService
{
    /** @var PodcastRepositoryInterface */
    private $podcastRepository;

    public function __construct(PodcastRepositoryInterface $podcastRepository)
    {
        $this->podcastRepository = $podcastRepository;
    }

    /**
     * @param int $id
     * @return Podcast|null
     */
    public function findPodcast(int $id): ?Podcast
    {
        return $this->podcastRepository->find($id);
    }

    /**
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function searchPodcasts(array $filters = []): LengthAwarePaginator
    {
        return $this->podcastRepository->search($filters);
    }

    /**
     * @param array $data
     * @return Podcast
     */
    public function storePodcast(array $data): Podcast
    {
        $podcast = $this->podcastRepository->createFromArray($data);
        return $podcast;
    }

    /**
     * @param Podcast $podcast
     * @param array $data
     * @return Podcast
     */
    public function updatePodcast(Podcast $podcast, array $data): Podcast
    {
        return $this->podcastRepository->updateFromArray($podcast, $data);
    }

    public function deletePodcast(Podcast $podcast): void
    {
        $this->podcastRepository->delete($podcast);
    }

    /**
     * @param Request $request
     * @param Podcast $podcast
     * @return bool
     */
    public function handleCoverUpload(Request $request, Podcast $podcast): bool
    {
        $file = $request->file('cover');
        if (!$file) {
            return false;
        }
        $filepath = $file->store('public/podcasts');
        $this->podcastRepository->updateFromArray($podcast, ['cover_file' => $filepath]);
        return true;
    }

    /**
     * Возвращает массив подкастов в формате id => name
     * @return array
     */
    public function getAssoc(): array
    {
        return $this->podcastRepository->getAssoc();
    }
}