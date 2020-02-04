<?php

namespace App\Http\Controllers\Admin\CategoryProduct;

use App\Http\Controllers\Admin\CategoryProduct\Requests\StoreCategoryRequest;
use App\Http\Controllers\Admin\CategoryProduct\Requests\UpdateCategoryRequest;
use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use App\Services\Category\CategoryService;
use Illuminate\Support\Facades\View;


class CategoryProductController extends Controller
{
    protected $categoryService;

    public function __construct(
        CategoryService $categoryService
    )
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function index()
    {
        //передаем в переменную выборку из базы
        View::share([
            'category'=>$this->categoryService->searchCategory()
        ]);
        return view('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreCategoryRequest $request)
    {
        //валидация данных
        $data = $request->getFormData();
        //сохраняем категорию через сервис
        $this->categoryService->createCategory($data);

        return redirect(route('admin.category.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function edit($id)
    {
        return view('admin.category.edit', [
            'category' => $this->categoryService->findCategory($id)
        ]);
    }

    /**
     * @param UpdateCategoryRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function update(UpdateCategoryRequest $request, CategoryProduct $category)
    {
        //валидация данных
        $data = $request->getFormData();

        $category = $this->categoryService->updateCategory($category,$data);

        View::share([
            'category'=>$category
        ]);

        return view('admin.category.edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $count = $this->categoryService->destroyCategory($id);

        return redirect(route('admin.category.index'));
    }
}
