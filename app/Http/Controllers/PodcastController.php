<?php

namespace App\Http\Controllers;

use App\Models\Podcast;
use App\Services\CategoryItunes\CategoryItunesService;
use App\Services\Podcast\PodcastService;
use Illuminate\Http\Request;

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
        $categoriesItunesList = $categoryItunesService->getAssoc();
        return view('podcasts.create', compact('podcast', 'categoriesItunesList'));
    }

    public function show(int $id)
    {
        // страницы для просмотра как таковой нет - сразу переходим в режим редакитрования
        return redirect(route('podcasts.edit', $id));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        // Пустой выбор категории (пустая строка) приводим к null для правильной вставки в базу
        if (isset($data['category_itunes_id'])) {
            $data['category_itunes_id'] = $data['category_itunes_id'] ?: null;
        }

        // Создаём новую запись о подкасте в базе
        $podcast = $this->podcastService->storePodcast($data);

        // Загрузим файл обложки и запишем в базу имя файла
        $this->podcastService->handleCoverUpload($request, $podcast);

        return redirect(route('podcasts.edit', $podcast))
            ->with('success', trans('podcast.save_success'));
    }

    public function edit(Podcast $podcast, CategoryItunesService $categoryItunesService)
    {
        $categoriesItunesList = $categoryItunesService->getAssoc();
        return view('podcasts.edit', compact('podcast', 'categoriesItunesList'));
    }

    public function update(Request $request, Podcast $podcast)
    {
        $data = $request->all();
        // Пустой выбор категории (пустая строка) приводим к null для правильной вставки в базу
        if (isset($data['category_itunes_id'])) {
            $data['category_itunes_id'] = $data['category_itunes_id'] ?: null;
        }

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
