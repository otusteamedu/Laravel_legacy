<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.product.index', ['products' => Products::paginate(),'category'=>$this->categoryProducts(CategoryProduct::all())]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = CategoryProduct::all();
        foreach ($category as $key => $item) {
            $result[$item->id] = $item->name;
        }

        return view('admin.product.create', ['category' => $result]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data = Arr::except($data, [
            '_token',
        ]);

        $store = Products::create($data);
        $insertedId = $store->id;

        return redirect(route('admin.product.index'));
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $product)
    {
        return view('admin.product.edit', ['product' => $product, 'category' => $this->categoryProducts(CategoryProduct::all())]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Products $product)
    {
        $data = $request->all();
        $data = Arr::except($data, [
            '_token',
        ]);

        $product->update($data);
        return view('admin.product.edit', ['product' => $product,'category' => $this->categoryProducts(CategoryProduct::all())]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $count = Products::destroy($id);
        return redirect(route('admin.product.index'));
    }

    private function categoryProducts($collection):array
    {
        $result = [];
        foreach ($collection as $key => $item) {
            $result[$item->id] = $item->name;
        }
        return $result;
    }
}
