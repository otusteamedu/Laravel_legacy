<?php

namespace App\Http\Controllers\Web\Admin\Articles;

use App\Http\Controllers\Web\Admin\Articles\Requests\StoreArticleRequest;
use App\Http\Controllers\Web\Admin\Articles\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Http\Controllers\Controller;
use App\Services\Articles\ArticlesService;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    protected $articlesService;

    public function __construct(ArticlesService $articlesService)
    {
        $this->articlesService = $articlesService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $articleList = $this->articlesService->searchArticles($request->all());
        \View::share([
            'articleList' => $articleList
        ]);

        return view('admin.articles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreArticleRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreArticleRequest $request)
    {
        $article = $this->articlesService->storeArticle($request->getFormData());

        return redirect(route('admin.articles.show', $article));
    }

    /**
     * Display the specified resource.
     *
     * @param Article $article
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Article $article)
    {
        return view('admin.articles.show', [
            'article' => $article
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Article $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('admin.articles.edit', [
            'article' => $article
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateArticleRequest $request
     * @param Article $article
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $this->articlesService->updateArticle($article, $request->getFormData());

        return redirect(route('admin.articles.show', $article));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Article $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $this->articlesService->deleteArticle($article);

        return view(
            'admin.articles.destroy',
            [
                'article' => $article
            ]
        );
    }
}
