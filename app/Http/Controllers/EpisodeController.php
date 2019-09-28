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

    public function show(int $id)
    {
        // страницы для просмотра как таковой нет - сразу переходим в режим редакитрования
        return redirect(route('episodes.edit', $id));
    }

    public function store(EpisodeRequest $request)
    {
        $data = $request->all();

        // Создаём новую запись об эпизоде в базе
        $episode = $this->episodeService->storeEpisode($data);

        // Загрузим файл обложки и запишем в базу имя файла
        $this->episodeService->handleCoverUpload($request, $episode);

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

        // Обновляем информацию об эпизоде в базе
        $this->episodeService->updateEpisode($episode, $data);

        // Загрузим файл обложки и запишем в базу имя файла
        $this->episodeService->handleCoverUpload($request, $episode);

        return redirect(route('episodes.edit', compact('episode')))
            ->with('success', trans('episode.save_success'));
    }

    public function destroy(Episode $episode)
    {
        $this->episodeService->deleteEpisode($episode);

        return redirect(route('episodes.index'));
    }
}
