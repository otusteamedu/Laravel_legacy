<?php

namespace App\Http\Controllers\Cms\User\Group;

use App\Http\Controllers\Cms\User\Group\Requests\StoreGroupRequest;
use App\Http\Controllers\Cms\User\Group\Requests\UpdateGroupRequest;
use App\Models\User\Group;
use App\Services\Cms\User\GroupsService;
use App\Services\Cms\User\RightsService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

/**
 * Class GroupsController
 * @package App\Http\Controllers\Cms\User\Group
 */
class GroupsController extends Controller
{
    /** @var GroupsService  */
    protected $groupsService;

    /** @var RightsService  */
    protected $rightsService;

    /**
     * GroupsController constructor.
     * @param GroupsService $groupsService
     * @param RightsService $rightsService
     */
    public function __construct(GroupsService $groupsService, RightsService $rightsService)
    {
        $this->groupsService = $groupsService;
        $this->rightsService = $rightsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('cms.group.index', [
            'groups' => $this->groupsService->paginationList(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('cms.group.create', [
            'rights' => $this->rightsService->getArrayList()
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
        $data = $request->getFormData();

        $url = $this->groupsService->store($data);

        return redirect($url);
    }

    /**
     * Display the specified resource.
     *
     * @param  Group $group
     * @return Factory|View
     */
    public function show(Group $group)
    {
        return view('cms.group.show', ['group' => $group]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Group $group
     * @return Factory|View
     */
    public function edit(Group $group)
    {
        return view('cms.group.edit', [
            'group' => $group,
            'rights' => $this->rightsService->getArrayList()
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
        $data = $request->getFormData();

        $url = $this->groupsService->update($group, $data);

        return redirect($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Group  $group
     * @return RedirectResponse|Redirector
     */
    public function destroy(Group $group)
    {
        $url = $this->groupsService->destroy($group);

        return redirect($url);
    }
}
