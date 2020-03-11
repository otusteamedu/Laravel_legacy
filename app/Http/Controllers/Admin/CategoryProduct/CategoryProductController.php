<?php

namespace App\Http\Controllers\Admin\CategoryProduct;

use App\Http\Controllers\Admin\CategoryProduct\Requests\StoreCategoryRequest;
use App\Http\Controllers\Admin\CategoryProduct\Requests\UpdateCategoryRequest;
use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use App\Policies\Abilities;
use App\Services\Category\CategoryService;
use Illuminate\Support\Facades\Auth;
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
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize(Abilities::VIEW_ANY, CategoryProduct::class);
        //передаем в переменную выборку из базы
        View::share([
            'category' => $this->categoryService->searchCategories()
        ]);
        return view('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize(CategoryProduct::class);
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
        $data['created_user_id'] = Auth::id();

        //сохраняем категорию через сервис
        $category = $this->categoryService->createCategory($data);

        info('Создана новая категория №'. $category->id.' " - '.$category->name.'" ');

        return redirect(route('admin.category.index',['locale'=>app()->getLocale()]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($id)
    {
        $this->authorize($this->categoryService->findCategory($id));

        return view('admin.category.edit', [
            'category' => $this->categoryService->findCategory($id)
        ]);
    }

    /**
     * @param UpdateCategoryRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateCategoryRequest $request, CategoryProduct $category)
    {

        $this->authorize($category);
        //валидация данных
        $data = $request->getFormData();

        $category = $this->categoryService->updateCategory($category, $data);

        View::share([
            'category' => $category
        ]);

        info('Обновлена категория №'. $category->id.' " - '.$category->name.'" ');

        return view('admin.category.edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($id)
    {
        $this->authorize(Abilities::DELETE, CategoryProduct::class);
        $count = $this->categoryService->destroyCategory($id);

        return redirect(route('admin.category.index',['locale'=>app()->getLocale()]));
    }
}
