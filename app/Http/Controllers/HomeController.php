<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleState;
use App\Models\Category;
use App\Services\ArticlesService;
use App\Services\CategoriesService;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    const RESOURCE_CACHE_KEY = 'PUBLIC';
    /**
     * @var ArticlesService
     */
    private $articlesService;

    /**
     * @var CategoriesService
     */
    private $categoriesService;

    /**
     * HomeController constructor.
     * @param ArticlesService $articlesService
     * @param CategoriesService $categoriesService
     */
    public function __construct(ArticlesService $articlesService, CategoriesService $categoriesService)
    {
        $this->articlesService = $articlesService;
        $this->categoriesService = $categoriesService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $page = request()->has('page') ? request()->get('page') : 1;
        $articles = $this->articlesService->allPaginatedBy([
            'criterias' => ['state_id' => ArticleState::STATE_PUBLISHED],
            'resourceCacheKey' => self::RESOURCE_CACHE_KEY,
            'page' => $page
        ]);
        $categoriesList = $this->categoriesService->getCategoriesList();

        return view('public.home', ['articles' => $articles, 'categories' => $categoriesList]);
    }

    /**
     * @param Article $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function article(Article $article)
    {
        $categoriesList = $this->categoriesService->getCategoriesList();

        return view('public.article', ['article' => $article, 'categories' => $categoriesList]);
    }

    /**
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function category(Category $category)
    {
        $articles = $category->articles()->paginate(5);
        $categoriesList = $this->categoriesService->getCategoriesList();

        return view('public.category', ['articles' => $articles, 'categories' => $categoriesList]);
    }

}
