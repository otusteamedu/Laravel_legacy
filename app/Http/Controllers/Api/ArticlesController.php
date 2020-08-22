<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Requests\IndexArticlesRequest;
use App\Http\Controllers\Api\Requests\StoreArticleRequest;
use App\Http\Controllers\Api\Requests\UpdateArticleRequest;
use App\Http\Controllers\Api\Resources\ArticleResource;
use App\Http\Controllers\Controller;
use App\Jobs\ArticleNotifyJob;
use App\Jobs\ArticlePrepareJob;
use App\Jobs\Queue;
use App\Models\Article;
use App\Services\ArticlesService;
use App\Services\CategoriesService;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{

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
        $this->articlesService = $articlesService;
        $this->categoriesService = $categoriesService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexArticlesRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(IndexArticlesRequest $request)
    {
        $page = $request->getPage();
        $articles = $this->articlesService->allPaginated(['page' => $page]);

        return ArticleResource::collection($articles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return ArticleResource
     */
    public function store(StoreArticleRequest $request)
    {
        $data = $request->getFormData();
        $article = $this->articlesService->createArticle($data);
        ArticlePrepareJob::withChain([
            new ArticleNotifyJob($article)
        ])->dispatch($article)->allOnQueue(Queue::PROCESS_ARTICLE_QUEUE);

        return new ArticleResource($article);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Article $article
     * @return ArticleResource
     */
    public function show(Article $article)
    {
        return new ArticleResource($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Article $article
     * @return ArticleResource
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        dd(1);
        $data = $request->getFormData();
        $article = $this->articlesService->updateArticle($article, $data);

        return new ArticleResource($article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Article $article)
    {
        try {
            $id = $article->id;
            $this->articlesService->deleteArticle($article);
            $message = sprintf('Статья #%d успешно удалена', $id);
        } catch (\Exception $e) {
            $message = sprintf('Возникла ошибка при удалении статьи #%d: %s', $id, $e->getMessage());
        }
        return response()->json(['status' => 'ok', 'message' => $message]);
    }
}
