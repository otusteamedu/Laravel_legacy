<?php

namespace App\Http\Controllers;

use App\Http\Requests\PodcastRequest;
use App\Models\Podcast;
use App\Services\CategoryItunes\CategoryItunesService;
use App\Services\Podcast\PodcastService;

class PodcastController extends Controller
{
    /**
     * @var PodcastService
     */
    private $podcastService;

    public function __construct(PodcastService $podcastService)
    {
        $this->podcastService = $podcastService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $podcasts = $this->podcastService->searchPodcasts();
        return view('podcasts.index', compact('podcasts'));
    }

    public function create(CategoryItunesService $categoryItunesService)
    {
        $podcast = new Podcast();
        $categoriesItunes = $categoryItunesService->getCategories();
        return view('podcasts.create', compact('podcast', 'categoriesItunes'));
    }

    public function show(int $id)
    {
        // страницы для просмотра как таковой нет - сразу переходим в режим редакитрования
        return redirect(route('podcasts.edit', $id));
    }

    public function store(PodcastRequest $request)
    {
        $data = $request->all();

        // Создаём новую запись о подкасте в базе
        $podcast = $this->podcastService->storePodcast($data);

        // Загрузим файл обложки и запишем в базу имя файла
        $this->podcastService->handleCoverUpload($request, $podcast);

        return redirect(route('podcasts.edit', $podcast))
            ->with('success', trans('podcast.save_success'));
    }

    public function edit(Podcast $podcast, CategoryItunesService $categoryItunesService)
    {
        $categoriesItunes = $categoryItunesService->getCategories();
        return view('podcasts.edit', compact('podcast', 'categoriesItunes'));
    }

    public function update(PodcastRequest $request, Podcast $podcast)
    {
        $data = $request->all();

        // Обновляем информацию о подкасте в базе
        $this->podcastService->updatePodcast($podcast, $data);

        // Загрузим файл обложки и запишем в базу имя файла
        $this->podcastService->handleCoverUpload($request, $podcast);

        return redirect(route('podcasts.edit', compact('podcast')))
            ->with('success', trans('podcast.save_success'));
    }

    public function destroy(Podcast $podcast)
    {
        $this->podcastService->deletePodcast($podcast);

        return redirect(route('podcasts.index'));
    }
}
