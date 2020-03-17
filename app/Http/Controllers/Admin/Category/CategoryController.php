<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Handlers\Category\CategoryHandlers;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Catalog\Category;

use App\Http\Repositories\Category\CategoryRepository;

class CategoryController extends Controller
{

    protected $categoryRepository;
    protected $categoryHandlers;

    public function __construct(
        CategoryRepository $categoryRepository,
        CategoryHandlers $categoryHandlers
    )
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryHandlers = $categoryHandlers;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = $this->categoryRepository->getCategoryPaginate();
        return view('admin.category.page', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentCategory = $this->categoryRepository->getParentCategory();

        return view('admin.category.page',[
            'category'=>[],
            'categories'=>$parentCategory,
            'delimits'=>'-'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
 
        $this->categoryHandlers->storeData($request);

        return redirect(route('admin.category.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Catalog\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catalog\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $parentCategory = $this->categoryRepository->getParentCategory();

        return view('admin.category.page', [
            'category'=>$category,
            'categories'=>$parentCategory,
            'delimits'=>'-'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catalog\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $this->categoryHandlers->updateData($category, $request);
        return redirect(route('admin.category.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catalog\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $this->categoryHandlers->destroyData($category);
        return redirect(route('admin.category.index'));
    }
}
