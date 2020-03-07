<?php

namespace App\Http\Controllers\Web\Admin\News;

use App\Http\Controllers\Web\Admin\News\Requests\StoreNewsRequest;
use App\Http\Controllers\Web\Admin\News\Requests\UpdateNewsRequest;
use App\Models\News;
use App\Http\Controllers\Controller;
use App\Services\News\NewsService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $newsList = $this->newsService->searchNews($request->all());
        \View::share([
            'newsList' => $newsList
        ]);

        return view('admin.news.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreNewsRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreNewsRequest $request)
    {
        $news = $this->newsService->storeNews($request->getFormData());

        return redirect(route('admin.news.show', $news));
    }

    /**
     * Display the specified resource.
     *
     * @param News $news
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(News $news)
    {
        return view('admin.news.show', [
            'news' => $news
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param News $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return view('admin.news.edit', [
            'news' => $news
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateNewsRequest $request
     * @param News $news
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNewsRequest $request, News $news)
    {
        $this->newsService->updateNews($news, $request->getFormData());

        return redirect(route('admin.news.show', $news));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param News $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $this->newsService->deleteNews($news);

        return view(
            'admin.news.destroy',
            [
                'news' => $news
            ]
        );
    }
}
