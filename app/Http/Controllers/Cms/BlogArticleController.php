<?php
namespace App\Http\Controllers\Cms;


use App\Http\Controllers\Controller;
use App\Models\Blog\BlogArticle;
use App\Models\Blog\BlogAuthor;
use View;
use Illuminate\Http\Request;
use App\Services\Blog\Articles\AuthorService;
use Illuminate\Foundation\Http\FormRequest;

class BlogArticleController extends Controller
{
    protected $blogArticleService;

    public function __construct(
        AuthorService $blogArticleService
    )
    {
        $this->blogArticleService = $blogArticleService;
    }

    public function index(Request $request)
    {
        View::share(Array(
            'articles' => BlogArticle::paginate(10)
        ));

        return view('cms.blog.article.index');
    }

    public function create()
    {

    }

    public function edit(BlogArticle $article)
    {
        $arAuthors = [];

        $authors = BlogAuthor::get();

        foreach ($authors as $author) {
            $arAuthors[$author->id] = $author->name;
        }

        View::share(Array(
            'article' => $article,
            'authors' => $arAuthors
        ));

        return view('cms.blog.article.edit');
    }

    public function store(FormRequest $request, BlogArticle $article)
    {
        View::share(Array(
            'article' => $article
        ));

        return view('cms.blog.article.edit');
    }

    public function delete(BlogAuthor $article)
    {
        dd($article);
    }

    public function show(int $id)
    {

    }
}
