<?php

namespace App\Http\Controllers;

use App\Models\Podcast;
use Illuminate\Http\Request;

class PodcastController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $podcasts = Podcast::with('latestEpisode')
            ->orderBy('name')
            ->paginate(20);

        return view('podcasts.index', compact('podcasts'));
    }

    public function create()
    {
        $podcast = new Podcast();
        $categoriesItunesList = $this->getCategoriesItunesList();
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
        $data['category_itunes_id'] = $data['category_itunes_id'] ?: null;
        $podcast = Podcast::create($data);

        // Загрузим файл обложки
        $this->handleCoverUpload($request, $podcast);

        return redirect(route('podcasts.edit', $podcast))
            ->with('success', trans('podcast.save_success'));
    }

    public function edit(Podcast $podcast)
    {
        $categoriesItunesList = $this->getCategoriesItunesList();
        return view('podcasts.edit', compact('podcast', 'categoriesItunesList'));
    }

    public function update(Request $request, Podcast $podcast)
    {
        $data = $request->all();
        // Пустой выбор категории (пустая строка) приводим к null для правильной вставки в базу
        $data['category_itunes_id'] = $data['category_itunes_id'] ?: null;
        $podcast->update($data);

        // Загрузим файл обложки
        $this->handleCoverUpload($request, $podcast);

        return redirect(route('podcasts.edit', compact('podcast')))
            ->with('success', trans('podcast.save_success'));
    }

    public function destroy(Podcast $podcast)
    {
        $podcast->delete();

        return redirect(route('podcasts.index'));
    }

    private function handleCoverUpload(Request $request, Podcast $podcast)
    {
        $coverFile = $request->file('cover');
        if ($coverFile) {
            $filepath = $coverFile->store('public/podcasts');
            $podcast->update(['cover_file' => $filepath]);
        }
    }

    private function getCategoriesItunesList()
    {
        $categories = \DB::select("SELECT id, name FROM categories_itunes ORDER BY name");
        return array_combine(array_column($categories, 'id'), array_column($categories, 'name'));
    }
}
