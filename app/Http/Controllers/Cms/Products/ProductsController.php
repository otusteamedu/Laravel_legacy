<?php

namespace App\Http\Controllers\Cms\Products;

use View;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Cms\CmsFormRequest;
use App\Http\Controllers\Cms\Products\Requests\StoreProductRequest;

use App\Models\Product;
use App\Services\Products\ProductsService;

class ProductsController extends Controller
{

    protected $productsService;

    public function __construct(
        ProductsService $productsService
    )
    {
        $this->productsService = $productsService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        View::share([
            'products' => Product::paginate(),
        ]);

        return view('products.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * @param StoreProductRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->getFormData();

        $this->productsService->storeProduct($data);

        return redirect(route('cms.products.index'));
    }

    /**
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Product $product)
    {
        return view('products.edit', [
            'product' => $product,
        ]);
    }

    /**
     * @param CmsFormRequest $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(CmsFormRequest $request, Product $product)
    {

        $this->productsService->updateProduct($product, $request->all());
        $product->update($request->all());

        return redirect(route('cms.products.index'));
    }

    /**
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Product $product)
    {

        return view('products.show', [
            'product' => $product,
            'categories' => $product->categories()->paginate(),
        ]);
    }

    /**
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
