<?php

namespace App\Http\Controllers\Cms\User\Right;

use App\Services\Cms\User\RightsService;
use Illuminate\Contracts\View\Factory;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Class RightsController
 * @package App\Http\Controllers\Cms\User\Right
 */
class RightsController extends Controller
{
    /** @var RightsService $rightsService */
    protected $rightsService;

    /**
     * RightsController constructor.
     * @param RightsService $rightsService
     */
    public function __construct(RightsService $rightsService)
    {
        $this->rightsService = $rightsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('cms.right.index', [
            'rights' => $this->rightsService->paginationList(),
        ]);
    }
}
