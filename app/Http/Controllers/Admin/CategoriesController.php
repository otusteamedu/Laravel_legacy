<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;

class CategoriesController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Category::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index()
    {
        $categories = Category::paginate(20);
        return  view('admin.categories-list', compact('categories'));
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
     * Создание/редактирования категории
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $categoryId = $request->id;
        try {
            $category = Category::updateOrCreate(['id' => $categoryId], $data);
            \Session::flash('alert-success', sprintf('Категория #%d успешно %s', $category->id, $request->id ? 'отредактирована' : 'создана'));
        } catch (\Exception $e) {
            \Session::flash('alert-danger', sprintf('Возникла ошибка при %s категории: %s', $request->id ? 'редактировании': 'создании', $e->getMessage()));
        }
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Category $category)
    {
        return response()->json($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Category $category)
    {
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        try {
            $id = $category->id;
            $category->delete();
            \Session::flash('alert-success', sprintf('Категория #%d успешно удалена', $id));
        } catch (\Exception $e) {
            \Session::flash('alert-danger', sprintf('Возникла ошибка при удалении категории #%d: %s', $id, $e->getMessage()));
        }
        return redirect()->route('categories.index');
    }
}
