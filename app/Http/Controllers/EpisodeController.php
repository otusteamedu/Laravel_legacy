<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Podcast;
use App\Services\Episode\EpisodeService;
use App\Services\Podcast\PodcastService;
use Illuminate\Http\Request;

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
        $podcastsList = $podcastService->getAssoc();
        return view('episodes.create', compact('episode', 'podcastsList'));
    }

    public function show(int $id)
    {
        // страницы для просмотра как таковой нет - сразу переходим в режим редакитрования
        return redirect(route('episodes.edit', $id));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $data['season'] = $data['season'] ?: null;
        $data['no'] = $data['no'] ?: null;

        // Создаём новую запись об эпизоде в базе
        $episode = $this->episodeService->storeEpisode($data);

        // Загрузим файл обложки и запишем в базу имя файла
        $this->episodeService->handleCoverUpload($request, $episode);

        return redirect(route('episodes.edit', $episode))
            ->with('success', trans('episode.save_success'));
    }

    public function edit(Episode $episode, PodcastService $podcastService)
    {
        $podcastsList = $podcastService->getAssoc();
        return view('episodes.edit', compact('episode', 'podcastsList'));
    }

    public function update(Request $request, Episode $episode)
    {
        $data = $request->all();

        $data['season'] = $data['season'] ?: null;
        $data['no'] = $data['no'] ?: null;

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
