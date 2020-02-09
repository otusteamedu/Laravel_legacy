<?php

namespace App\Http\Controllers\Cms\Page;

use App\Http\Controllers\Cms\Page\Requests\StorePostRequest;
use App\Http\Controllers\Cms\Page\Requests\UpdatePostRequest;
use App\Models\Page\Page;
use App\Services\Cms\Page\PagesService;
use Illuminate\Contracts\View\Factory;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

/**
 * Class PagesController
 * @package App\Http\Controllers\Cms\Page
 */
class PagesController extends Controller
{
    /** @var PagesService  */
    protected $pagesService;

    /**
     * PagesController constructor.
     * @param PagesService $pagesService
     */
    public function __construct(PagesService $pagesService)
    {
        $this->pagesService = $pagesService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('cms.page.index', [
            'pages' => $this->pagesService->paginationList(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('cms.page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePostRequest  $request
     * @return RedirectResponse|Redirector
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->getFormData();

        $url = $this->pagesService->store($data);

        return redirect($url);
    }

    /**
     * Display the specified resource.
     *
     * @param Page $page
     * @return Factory|View
     */
    public function show(Page $page)
    {
        return view('cms.page.show', ['page' => $page]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Page  $page
     * @return Factory|View
     */
    public function edit(Page $page)
    {
        return view('cms.page.edit', ['page' => $page]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePostRequest  $request
     * @param  Page  $page
     * @return RedirectResponse|Redirector
     */
    public function update(UpdatePostRequest $request, Page $page)
    {
        $data = $request->getFormData();

        $url = $this->pagesService->update($page, $data);

        return redirect($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Page  $page
     * @return RedirectResponse|Redirector
     */
    public function destroy(Page $page)
    {
       $url = $this->pagesService->destroy($page);

       return redirect($url);
    }
}
