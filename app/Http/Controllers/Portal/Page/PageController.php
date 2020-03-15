<?php

namespace App\Http\Controllers\Portal\Page;

use App\Http\Controllers\Controller;
use App\Services\Portal\Page\PagesService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class PageController
 * @package App\Http\Controllers\Portal\Page
 */
class PageController extends Controller
{
    /** @var PagesService $pagesService */
    protected $pagesService;

    /**
     * PageController constructor.
     * @param PagesService $pagesService
     */
    public function __construct(PagesService $pagesService)
    {
        $this->pagesService = $pagesService;
    }

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Factory|View
     */
    public function show(Request $request)
    {
        return view('portal.pages.page', [
            'page' => $this->pagesService->getPage($request),
        ]);
    }
}
