<?php

namespace App\Http\Controllers\Cms\Page;

use App\Http\Controllers\Cms\Page\Requests\StorePageRequest;
use App\Http\Controllers\Cms\Page\Requests\UpdatePageRequest;
use App\Models\Page\Page;
use App\Http\Controllers\Cms\CurrentUser;
use App\Policies\Abilities;
use App\Services\Cms\Page\PagesService;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

/**
 * Class PagesController
 * @package App\Http\Controllers\Cms\Page
 */
class PagesController extends Controller
{
    use CurrentUser;

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
     * @throws AuthorizationException
     */
    public function index()
    {
        $this->authorize(Abilities::VIEW_ANY, Page::class);

        return view('cms.page.index', [
            'pages' => $this->pagesService->paginationList(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize(Abilities::CREATE, Page::class);

        return view('cms.page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePageRequest  $request
     * @return RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function store(StorePageRequest $request)
    {
        $this->authorize(Abilities::CREATE, Page::class);

        $data = $request->getFormData();

        $url = $this->pagesService->store($data);

        return redirect($url);
    }

    /**
     * Display the specified resource.
     *
     * @param Page $page
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function show(Page $page)
    {
        $this->authorize(Abilities::VIEW, $page);

        return view('cms.page.show', ['page' => $page]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Page  $page
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function edit(Page $page)
    {
        $this->authorize(Abilities::UPDATE, $page);

        return view('cms.page.edit', ['page' => $page]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePageRequest  $request
     * @param  Page  $page
     * @return RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function update(UpdatePageRequest $request, Page $page)
    {
        $this->authorize(Abilities::UPDATE, $page);

        $data = $request->getFormData();

        $url = $this->pagesService->update($page, $data);

        return redirect($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Page  $page
     * @return RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function destroy(Page $page)
    {
        $this->authorize(Abilities::DELETE, $page);

        $url = $this->pagesService->destroy($page);

        return redirect($url);
    }
}
