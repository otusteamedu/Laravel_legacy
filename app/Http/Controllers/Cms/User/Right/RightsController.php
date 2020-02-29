<?php

namespace App\Http\Controllers\Cms\User\Right;

use App\Models\User\Right;
use App\Policies\Abilities;
use App\Services\Cms\User\RightsService;
use Illuminate\Auth\Access\AuthorizationException;
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
     * @throws AuthorizationException
     */
    public function index()
    {
        $this->authorize(Abilities::VIEW_ANY, Right::class);

        return view('cms.right.index', [
            'rights' => $this->rightsService->paginationList(),
        ]);
    }
}
