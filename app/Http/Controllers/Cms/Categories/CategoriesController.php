<?php

namespace App\Http\Controllers\Cms\Categories;

use View;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Cms\CmsFormRequest;
use App\Http\Controllers\Cms\Categories\Requests\StoreCategoryRequest;

use App\Models\Category;
use App\Services\Categories\CategoriesService;
use App\Services\Products\ProductsService;

class CategoriesController extends Controller
{
    protected $categoriesService;
    protected $productsService;

    public function __construct(
        CategoriesService $categoriesService,
        ProductsService $productsService
    )
    {
        $this->categoriesService = $categoriesService;
        $this->productsService = $productsService;
    }
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {

        return view('categories.index', [
            'categories' => $this->categoriesService->searchCategories(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {

        return view('categories.create');
    }

    /**
     * @param StoreCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCategoryRequest $request)
    {

        $data = $request->getFormData();

        $this->categoriesService->createCategory($data);

        return redirect(route('cms.categories.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Category $category)
    {
        return view('categories.edit', [
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CmsFormRequest $request
     * @param  Category  $category
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(CmsFormRequest $request, Category $category)
    {

        $this->categoriesService->updateCategory($category, $request->all());
        $category->update($request->all());

        return redirect(route('cms.categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
