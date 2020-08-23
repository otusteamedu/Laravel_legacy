<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Requests\UpdateArticleRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Requests\StoreArticleRequest;
use App\Jobs\ArticleNotifyJob;
use App\Jobs\ArticlePrepareJob;
use App\Jobs\Queue;
use App\Models\Article;
use App\Models\Category;
use App\Services\CategoriesService;
use App\Services\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use App\Services\ArticlesService;

/**
 * Class ArticlesController
 * @package App\Http\Controllers\Admin
 */
class ArticlesController extends Controller
{
    const RESOURCE_CACHE_KEY = 'ADMIN';

    /**
     * @var ArticlesService
     */
    private $articlesService;

    /**
     * @var CategoriesService
     */
    private $categoriesService;

    /**
     * ArticlesController constructor.
     * @param ArticlesService $articlesService
     * @param CategoriesService $categoriesService
     */
    public function __construct(ArticlesService $articlesService, CategoriesService $categoriesService)
    {
        $this->authorizeResource(Article::class);
        $this->articlesService = $articlesService;
        $this->categoriesService = $categoriesService;
    }

    /**
     * Список статей
     *
     * @return Renderable
     */
    public function index()
    {
        $page = request()->has('page') ? request()->get('page') : 1;
        $categoriesList = $this->categoriesService->getCategoriesList();
        $articles = $this->articlesService->allPaginated(['page' => $page], self::RESOURCE_CACHE_KEY);
        return view('admin.articles-list', ['articles' => $articles, 'categoriesList' => $categoriesList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Создание статьи
     *
     * @param StoreArticleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreArticleRequest $request)
    {
        $data = $request->getFormData();
        try {
            $article = $this->articlesService->createArticle($data);
            ArticlePrepareJob::withChain([
                new ArticleNotifyJob($article)
            ])->dispatch($article)->allOnQueue(Queue::PROCESS_ARTICLE_QUEUE);
            \Session::flash('alert-success', sprintf('Статья #%d успешно создана', $article->id));
        } catch (\Exception $e) {
            \Session::flash('alert-danger', sprintf('Возникла ошибка при создании статьи: %s', $e->getMessage()));
        }
        return response()->json(['status' => 'ok', 'redirect' => route('articles.index')]);
    }

    /**
     * Получение данных для формы просмотра
     *
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Article $article)
    {
        return response()->json($article);
    }

    /**
     * Получение данных для формы редактирования
     *
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Article $article)
    {
        return response()->json($article);
    }

    /**
     * Редактирование статьи
     *
     * @param UpdateArticleRequest $request
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $data = $request->getFormData();
        try {
            $article = $this->articlesService->updateArticle($article, $data);
            \Session::flash('alert-success', sprintf('Статья #%d успешно отредактирована', $article->id));
        } catch (\Exception $e) {
            \Session::flash('alert-danger',
                sprintf('Возникла ошибка при редактировании статьи #%d: %s', $article->id, $e->getMessage()));
        }
        return response()->json(['status' => 'ok', 'redirect' => route('articles.index')]);
    }

    /**
     * Удаление статьи
     *
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Article $article)
    {
        try {
            $id = $article->id;
            $this->articlesService->deleteArticle($article);
            \Session::flash('alert-success', sprintf('Статья #%d успешно удалена', $id));
        } catch (\Exception $e) {
            \Session::flash('alert-danger',
                sprintf('Возникла ошибка при удалении статьи #%d: %s', $id, $e->getMessage()));
        }
        return redirect()->route('articles.index');
    }
}
