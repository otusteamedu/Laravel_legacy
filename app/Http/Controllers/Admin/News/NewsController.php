<?php

namespace App\Http\Controllers\Admin\News;

use App\Helpers\FilesWork;
use App\Helpers\RouteBuilder;
use App\Http\Controllers\Controller;
use App\Http\Handlers\News\NewsHandlers;
use App\Http\Requests\News\StoreNewsRequest;
use App\Http\Requests\News\UpdateNewsRequest;
use App\Http\Services\News\NewsService;
use App\Models\News;

class NewsController extends Controller
{

    const PAGINATE_COUNT = 6;

    protected $newsService;

    public function __construct(
        NewsService $newsService
    )
    {
        $this->newsService = $newsService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $news = News::paginate(self::PAGINATE_COUNT);

        return view('admin.news.page', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.page');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\News\StoreNewsRequest  $request
     * @return App\Http\Requests\News\StoreNewsRequest
     */
    public function store(StoreNewsRequest $request)
    {
        $requestArray = $request->getFormArray($request->file);
        $news = $this->newsService->createNews($requestArray);

        FilesWork::storeFile($request->file, News::FILE_PATH, $news->id);

        return redirect(route('admin.news.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return view('admin.news.page', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\News\UpdateNewsRequest  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNewsRequest $request, News $news)
    {
        $requestArray = $request->getFormArray($request->file);
        
        $this->newsService->updateNews($news, $requestArray);

        FilesWork::storeFile($request->file, News::FILE_PATH, $news->id);

        return redirect(route('admin.news.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $this->newsService->deleteNews($news);
        return redirect(route('admin.news.index'));
    }


}
