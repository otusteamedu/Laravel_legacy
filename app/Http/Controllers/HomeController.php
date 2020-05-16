<?php

namespace App\Http\Controllers;

use App\Models\Article;
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
        return view('home', ['news'=>$articles]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function article($id)
    {
        $article = Article::find($id);
        return view('article', ['article'=> $article]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function category($id) {
        $articles = Article::where('category', $id)->orderBy('published', 'desc')->get();
        return view('category', ['news'=> $articles]);
    }

    /**
     * @param string $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list($type) {
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
