<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Http\Handlers\News\NewsHandlers;
use App\Http\Requests\News\StoreNewsRequest;
use App\Http\Requests\News\UpdateNewsRequest;
use App\Models\News;


class NewsController extends Controller
{

    protected $newsHandlers;

    public function __construct(
        NewsHandlers $newsHandlers
    )
    {
        $this->newsHandlers = $newsHandlers;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $news = News::paginate(6);

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
        $this->newsHandlers->storeData($request);
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
        $this->newsHandlers->updateData($news, $request);
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
        $this->newsHandlers->destroyData($news);
        return redirect(route('admin.news.index'));
    }
}
