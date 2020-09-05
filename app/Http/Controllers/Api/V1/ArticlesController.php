<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\Requests\IndexArticlesRequest;
use App\Http\Controllers\Api\Requests\StoreArticleRequest;
use App\Http\Controllers\Api\Requests\UpdateArticleRequest;
use App\Http\Controllers\Api\Resources\ArticleResource;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Services\ArticlesService;
use App\Services\CategoriesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ArticlesController extends Controller
{

    const RESOURCE_CACHE_KEY = 'ARTICLES_API';

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
        $articles = $this->articlesService->allPaginated(['page' => $page], self::RESOURCE_CACHE_KEY);

        return ArticleResource::collection($articles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreArticleRequest $request
     * @return ArticleResource
     */
    public function store(StoreArticleRequest $request)
    {
        $data = $request->getFormData();
        $article = $this->articlesService->createArticle($data);
        $this->articlesService->runPrepareJob($article);

        return new ArticleResource($article);
    }

    /**
     * Display the specified resource.
     *
     * @param Article $article
     * @return ArticleResource
     */
    public function show(Article $article)
    {
        return new ArticleResource($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateArticleRequest $request
     * @param Article $article
     * @return ArticleResource
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $data = $request->getFormData();
        $article = $this->articlesService->updateArticle($article, $data);

        return new ArticleResource($article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Article $article
     * @return JsonResponse
     */
    public function destroy(Article $article)
    {
        try {
            $id = $article->id;
            $this->articlesService->deleteArticle($article);
            $status = Response::HTTP_OK;
            $message = sprintf('Статья #%d успешно удалена', $id);
        } catch (\Exception $e) {
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
            $message = sprintf('Возникла ошибка при удалении статьи #%d: %s', $id, $e->getMessage());
        }
        return response()->json(['message' => $message], $status);
    }
}
