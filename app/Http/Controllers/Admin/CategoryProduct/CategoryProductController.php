<?php

namespace App\Http\Controllers\Admin\CategoryProduct;

use App\Http\Controllers\Admin\CategoryProduct\Requests\StoreCategoryRequest;
use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use App\Services\Category\CaregoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class CategoryProductController extends Controller
{
    protected $categoryService;

    public function __construct(
        CaregoryService $categoryService
    )
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        View::share([
//            'category'=>CategoryProduct::paginate()
//        ]);
        return view('admin.category.index', ['category' => CategoryProduct::paginate()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
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
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CategoryProduct $category
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryProduct $category)
    {
        return view('admin.category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoryProduct $category)
    {


        $data = $request->all();
        $data = Arr::except($data, [
            '_token',
        ]);

        $category->update($data);
        return view('admin.category.edit', ['category' => $category]);
        return redirect(route('admin.category.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $count = CategoryProduct::destroy($id);
        if ($count) {
            return redirect(route('admin.category.index'));
        }
//        TODO обработать ошибку ?
    }
}
