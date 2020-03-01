<?php

namespace App\Http\Controllers\Cms\User\Group;

use App\Http\Controllers\Cms\CurrentUser;
use App\Http\Controllers\Cms\User\Group\Requests\StoreGroupRequest;
use App\Http\Controllers\Cms\User\Group\Requests\UpdateGroupRequest;
use App\Models\User\Group;
use App\Policies\Abilities;
use App\Services\Cms\User\GroupsService;
use App\Services\Cms\User\RightsService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

/**
 * Class GroupsController
 * @package App\Http\Controllers\Cms\User\Group
 */
class GroupsController extends Controller
{
    use CurrentUser;

    /** @var GroupsService  */
    protected $groupsService;

    /** @var RightsService  */
    protected $rightsService;

    /** @var string  */
    protected $locale;

    /**
     * GroupsController constructor.
     * @param GroupsService $groupsService
     * @param RightsService $rightsService
     */
    public function __construct(GroupsService $groupsService, RightsService $rightsService)
    {
        $this->groupsService = $groupsService;
        $this->rightsService = $rightsService;
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
        $this->checkAbility($request, Abilities::VIEW_ANY, Group::class);

        return view('cms.group.index', [
            'groups' => $this->groupsService->paginationList(),
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
        $this->checkAbility($request, Abilities::CREATE, Group::class);

        return view('cms.group.create', [
            'rights' => $this->rightsService->getArrayList(),
            'locale' => $this->locale,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreGroupRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(StoreGroupRequest $request)
    {
        $this->checkAbility($request, Abilities::CREATE, Group::class);

        $data = $request->getFormData();

        $url = $this->groupsService->store($data);

        return redirect($url);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Group $group
     * @return Factory|View
     */
    public function show(Request $request, Group $group)
    {
        $this->checkAbility($request, Abilities::VIEW, $group);

        return view('cms.group.show', [
            'group' => $group,
            'locale' => $this->locale,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param Group $group
     * @return Factory|View
     */
    public function edit(Request $request, Group $group)
    {
        $this->checkAbility($request, Abilities::UPDATE, $group);

        return view('cms.group.edit', [
            'group' => $group,
            'rights' => $this->rightsService->getArrayList(),
            'locale' => $this->locale,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateGroupRequest  $request
     * @param  Group  $group
     * @return RedirectResponse|Redirector
     */
    public function update(UpdateGroupRequest $request, Group $group)
    {
        $this->checkAbility($request, Abilities::UPDATE, $group);

        $data = $request->getFormData();

        $url = $this->groupsService->update($group, $data);

        return redirect($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Group $group
     * @return RedirectResponse|Redirector
     */
    public function destroy(Request $request, Group $group)
    {
        $this->checkAbility($request, Abilities::DELETE, $group);

        $url = $this->groupsService->destroy($group);

        return redirect($url);
    }
}
