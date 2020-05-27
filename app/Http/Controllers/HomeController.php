<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $articles = Article::all();
        $categories = Category::all();
        return view('home', ['news' => $articles, 'categories' => $categories]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function article($id)
    {
        $article = Article::find($id);
        $categories = Category::all();
        return view('article', ['article' => $article, 'categories' => $categories]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function category($id)
    {
        $articles = Article::where('category_id', $id)->orderBy('published_at', 'desc')->get();
        $categories = Category::all();
        return view('category', ['news' => $articles, 'categories' => $categories]);
    }

    /**
     * @param string $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list($type)
    {
        switch ($type) {
            case 'categories':
                $result = DB::table('articles')
                    ->select('category', DB::raw('count(id) as total'))
                    ->groupBy('category')
                    ->get();
        }

        return view('list', ['result' => $result]);
    }
}
