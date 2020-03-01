<?php

namespace App\Http\Controllers\Cms\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Cms\Page\Requests\StorePageRequest;
use App\Http\Controllers\Cms\Page\Requests\UpdatePageRequest;
use App\Models\Page\Page;
use App\Http\Controllers\Cms\CurrentUser;
use App\Policies\Abilities;
use App\Services\Cms\Page\PagesService;
use App\Http\Controllers\Controller;
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

    /** @var PagesService */
    protected $pagesService;

    /** @var string */
    protected $locale;

    /**
     * PagesController constructor.
     * @param PagesService $pagesService
     */
    public function __construct(PagesService $pagesService)
    {
        $this->pagesService = $pagesService;
        $this->locale = \App::getLocale();
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $this->checkAbility($request, Abilities::VIEW_ANY, Page::class);

        return view('cms.page.index', [
            'pages' => $this->pagesService->paginationList(),
            'locale' => $this->locale,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Factory|View
     */
    public function create(Request $request)
    {
        $this->checkAbility($request, Abilities::CREATE, Page::class);

        return view('cms.page.create', [
            'locale' => $this->locale,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePageRequest  $request
     * @return RedirectResponse|Redirector
     */
    public function store(StorePageRequest $request)
    {
        $this->checkAbility($request, Abilities::CREATE, Page::class);

        $data = $request->getFormData();

        $url = $this->pagesService->store($data);

        return redirect($url);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Page $page
     * @return Factory|View
     */
    public function show(Request $request, Page $page)
    {
        $this->checkAbility($request, Abilities::VIEW, $page);

        return view('cms.page.show', [
            'page' => $page,
            'locale' => $this->locale,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param  Page  $page
     * @return Factory|View
     */
    public function edit(Request $request, Page $page)
    {
        $this->checkAbility($request, Abilities::UPDATE, $page);

        return view('cms.page.edit', [
            'page' => $page,
            'locale' => $this->locale,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePageRequest  $request
     * @param  Page  $page
     * @return RedirectResponse|Redirector
     */
    public function update(UpdatePageRequest $request, Page $page)
    {
        $this->checkAbility($request, Abilities::UPDATE, $page);

        $data = $request->getFormData();

        $url = $this->pagesService->update($page, $data);

        return redirect($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param  Page  $page
     * @return RedirectResponse|Redirector
     */
    public function destroy(Request $request, Page $page)
    {
        $this->checkAbility($request, Abilities::DELETE, $page);

        $url = $this->pagesService->destroy($page);

        return redirect($url);
    }
}
