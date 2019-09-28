<?php

namespace App\Http\Controllers;

use App\Http\Requests\EpisodeRequest;
use App\Models\Episode;
use App\Services\Episode\EpisodeService;
use App\Services\Podcast\PodcastService;

class EpisodeController extends Controller
{
    /**
     * @var EpisodeService
     */
    private $episodeService;

    public function __construct(EpisodeService $episodeService)
    {
        $this->episodeService = $episodeService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $episodes = $this->episodeService->searchEpisodes();
        return view('episodes.index', compact('episodes'));
    }

    public function create(PodcastService $podcastService)
    {
        $episode = new Episode();
        $podcasts = $podcastService->getPodcasts();
        return view('episodes.create', compact('episode', 'podcasts'));
    }

    public function store(EpisodeRequest $request)
    {
        $data = $request->all();
        $data['cover'] = $request->file('cover');

        // Создаём новую запись об эпизоде в базе
        $episode = $this->episodeService->storeEpisode($data);

        return redirect(route('episodes.edit', $episode))
            ->with('success', trans('episode.save_success'));
    }

    public function edit(Episode $episode, PodcastService $podcastService)
    {
        $podcasts = $podcastService->getPodcasts();
        return view('episodes.edit', compact('episode', 'podcasts'));
    }

    public function update(EpisodeRequest $request, Episode $episode)
    {
        $data = $request->all();
        $data['cover'] = $request->file('cover');

        // Обновляем информацию об эпизоде в базе
        $this->episodeService->updateEpisode($episode, $data);

        return redirect(route('episodes.edit', compact('episode')))
            ->with('success', trans('episode.save_success'));
    }

    public function destroy(Episode $episode)
    {
        $this->episodeService->deleteEpisode($episode);

        return redirect(route('episodes.index'));
    }
}
