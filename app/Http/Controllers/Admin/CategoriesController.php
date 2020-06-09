<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\CategoriesService;
use App\Http\Controllers\Admin\Requests\StoreCategoryRequest;
use App\Http\Controllers\Admin\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;

class CategoriesController extends Controller
{

    private $categoriesService;

    public function __construct(CategoriesService $categoriesService)
    {
        $this->categoriesService = $categoriesService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index()
    {
        $categories = $this->categoriesService->allPaginated();
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
     * Создание категории
     *
     * @param StoreCategoryRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->getFormData();
        try {
            $category = $this->categoriesService->createCategory($data);
            \Session::flash('alert-success', sprintf('Категория #%d успешно создана', $category->id));
        } catch (\Exception $e) {
            \Session::flash('alert-danger', sprintf('Возникла ошибка при создании категории: %s', $e->getMessage()));
        }
        return response()->json(['status'=> 'ok', 'redirect'=> route('categories.index')]);
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
     * Редактирование категории
     *
     * @param UpdateCategoryRequest $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $data = $request->getFormData();
        try {
            $category = $this->categoriesService->updateCategory($category, $data);
            \Session::flash('alert-success', sprintf('Статья #%d успешно отредактирована', $category->id));
        } catch (\Exception $e) {
            \Session::flash('alert-danger', sprintf('Возникла ошибка при редактировании статьи #%d: %s', $category->id, $e->getMessage()));
        }
        return response()->json(['status'=> 'ok', 'redirect'=> route('categories.index')]);
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
            $this->categoriesService->deleteCategory($category);
            \Session::flash('alert-success', sprintf('Категория #%d успешно удалена', $id));
        } catch (\Exception $e) {
            \Session::flash('alert-danger', sprintf('Возникла ошибка при удалении категории #%d: %s', $id, $e->getMessage()));
        }
        return redirect()->route('categories.index');
    }
}
