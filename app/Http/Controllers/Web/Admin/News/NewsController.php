<?php

namespace App\Http\Controllers\Web\Admin\News;

use App\Http\Controllers\Web\Admin\News\Requests\StoreNewsRequest;
use App\Http\Controllers\Web\Admin\News\Requests\UpdateNewsRequest;
use App\Models\News;
use App\Http\Controllers\Controller;
use App\Policies\Abilities;
use App\Services\News\NewsService;
use Illuminate\Http\Request;

/**
 * Class NewsController
 * @package App\Http\Controllers\Web\Admin\News
 */
class NewsController extends Controller
{
    protected $newsService;

    /**
     * NewsController constructor.
     * @param NewsService $newsService
     */
    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize(Abilities::VIEW_ANY, News::class);

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
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize(Abilities::CREATE, News::class);

        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreNewsRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreNewsRequest $request)
    {
        $this->authorize(Abilities::CREATE, News::class);

        $news = $this->newsService->storeNews($request->getFormData());

        return redirect(route('admin.news.show', $news));
    }

    /**
     * Display the specified resource.
     *
     * @param News $news
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(News $news)
    {
        $this->authorize(Abilities::VIEW, News::class);

        return view('admin.news.show', [
            'news' => $news
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param News $news
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(News $news)
    {
        $this->authorize(Abilities::UPDATE, News::class);

        return view('admin.news.edit', [
            'news' => $news
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateNewsRequest $request
     * @param News $news
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateNewsRequest $request, News $news)
    {
        $this->authorize(Abilities::UPDATE, News::class);

        $this->newsService->updateNews($news, $request->getFormData());

        return redirect(route('admin.news.show', $news));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param News $news
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(News $news)
    {
        $this->authorize(Abilities::DELETE, News::class);

        $this->newsService->deleteNews($news);

        return view(
            'admin.news.destroy',
            [
                'news' => $news
            ]
        );
    }
}
