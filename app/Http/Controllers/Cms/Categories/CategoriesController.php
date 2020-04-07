<?php

namespace App\Http\Controllers\Cms\Categories;

use App\Http\Controllers\Cms\Categories\Requests\StoreCategoryRequest;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\Categories\CategoriesService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use View;


class CategoriesController extends Controller
{
    /**
     * @var CategoriesService
     */
    protected $categoriesService;

    public function __construct(
        CategoriesService $categoriesService
    )
    {
        $this->categoriesService = $categoriesService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('cms.categories.index', ['categories' => Category::paginate()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        if (Gate::allows('create-category')) {
            return view('cms.categories.create');
        } else {
            return view('plain.not-allowed');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->getFormData();

        $this->categoriesService->storeCategory($data);

        return redirect(route('cms.categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Category $category)
    {
        return view('cms.categories.show', [
            'category' => $category,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Category $category)
    {
        if (Gate::allows('update-category')) {
            return view('cms.categories.edit', [
                'category' => $category,
            ]);
        } else {
            return view('plain.not-allowed');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Category $category)
    {
        $this->authorize(Abilities::UPDATE, $category);

        $this->categoriesService->updateCategory($category, $request->all());
        $category->update($request->all());

        return redirect(route('cms.categories.index'));
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
