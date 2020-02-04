<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Admin\Product\Requests\StoreProductRequest;
use App\Http\Controllers\Admin\Product\Requests\UpdateProductRequest;
use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use App\Models\Products;
use App\Services\Category\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\View;
use App\Services\Product\ProductService;

class ProductController extends Controller
{
    protected $productService;
    protected $categoryService;

    public function __construct(
        ProductService $productService,
        CategoryService $categoryService
    )
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        View::share([
            'products' => $this->productService->searchProduct(),
        ]);
        return view('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $category = $this->categoryService->getAllCategory();

        $category = $this->categoryService->formatCategoryToArray($category);

        View::share([
            'category' => $category,
        ]);
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreProductRequest $request)
    {
        //валидация данных
        $data = $request->getFormData();
        $this->productService->createProduct($data);

        return redirect(route('admin.product.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $category = $this->categoryService->getAllCategory();
        $category = $this->categoryService->formatCategoryToArray($category);

        View::share([
            'product' => $this->productService->findProduct($id),
            'category' => $category,
        ]);
        return view('admin.product.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param Products $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(UpdateProductRequest $request, Products $product)
    {
        //валидация данных
        $data = $request->getFormData();
        $product = $this->productService->updateProduct($product, $data);

        $category = $this->categoryService->getAllCategory();
        $category = $this->categoryService->formatCategoryToArray($category);

        View::share([
            'product' => $product,
            'category' => $category,
        ]);

        return view('admin.product.edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $count = $this->productService->destroyProduct($id);

        return redirect(route('admin.product.index'));
    }

}
