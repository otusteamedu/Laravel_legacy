<?php

namespace App\Http\Controllers\Cms\User\Right;

use App\Http\Controllers\Cms\CurrentUser;
use App\Models\User\Right;
use App\Policies\Abilities;
use App\Services\Cms\User\RightsService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class RightsController
 * @package App\Http\Controllers\Cms\User\Right
 */
class RightsController extends Controller
{
    use CurrentUser;

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
     * @param Request $request
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function index(Request $request)
    {
        $this->checkAbility($request, Abilities::VIEW_ANY, Right::class);

        return view('cms.right.index', [
            'rights' => $this->rightsService->paginationList(),
        ]);
    }
}
