<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index()
    {
        $categories = Category::all(['id', 'title']);
        $categoryList = [];
        foreach ($categories as $category) {
            $categoryList[$category->id] = $category->title;
        }
        $articles = Article::paginate(20);
        return view('admin.articles-list', ['articles' => $articles, 'categoryList' => $categoryList]);
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
     * Создание/редактирования статьи
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['state'] = 1;
        $data['user_id'] = \Auth::user()->id;
        $articleId = $request->id;
        try {
            $article = Article::updateOrCreate(['id' => $articleId], $data);
            \Session::flash('alert-success', sprintf('Статья #%d успешно %s', $article->id, $request->id ? 'отредактирована' : 'создана'));
        } catch (\Exception $e) {
            \Session::flash('alert-danger', sprintf('Возникла ошибка при %s статьи: %s', $request->id ? 'редактировании': 'создании', $e->getMessage()));
        }
        return redirect()->route('articles.index');
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
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Article $article
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Article $article)
    {
        try {
            $id = $article->id;
            $article->delete();
            \Session::flash('alert-success', sprintf('Статья #%d успешно удалена', $id));
        } catch (\Exception $e) {
            \Session::flash('alert-danger', sprintf('Возникла ошибка при удалении статьи #%d: %s', $id, $e->getMessage()));
        }
        return redirect()->route('articles.index');
    }
}
