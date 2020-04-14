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
    const CREATE_OPERATION = 'create-category';
    const UPDATE_OPERATION = 'update-category';
    const INDEX_VIEW = 'cms.categories.index';
    const SHOW_VIEW = 'cms.categories.show';
    const CREATE_VIEW = 'cms.categories.create';
    const EDIT_VIEW = 'cms.categories.edit';


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
        return view(self::INDEX_VIEW, ['categories' => Category::paginate()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        if (!Gate::allows(self::CREATE_OPERATION)) {
            return view('errors.custom', ['message' => config('exceptions.messages.not-allowed')]);
        }
        return view(self::CREATE_VIEW);
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

        try {
            $this->categoriesService->storeCategory($data);
        } catch (\Exception $e) {
            \Log::channel('slack-critical')->critical(__METHOD__ . ': ' . $e->getMessage());
            return response()->json([
                'message' => 'Store category error',
                'errors' => [[$e->getMessage()]],
            ]);
        }

        return redirect(route(self::INDEX_VIEW));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Category $category)
    {
        return view(self::SHOW_VIEW, [
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
        if (!Gate::allows(self::UPDATE_OPERATION)) {
            return view('errors.custom', ['message' => config('exceptions.messages.not-allowed')]);
        }
        return view(self::EDIT_VIEW, [
            'category' => $category,
        ]);
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
        try {
            $this->categoriesService->updateCategory($category, $request->all());
            $category->update($request->all());
        } catch (\Exception $e) {
            \Log::channel('slack-critical')->critical(__METHOD__ . ': ' . $e->getMessage());
            return response()->json([
                'message' => 'Update category error',
                'errors' => [[$e->getMessage()]],
            ]);
        }

        return redirect(route(self::INDEX_VIEW));
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
