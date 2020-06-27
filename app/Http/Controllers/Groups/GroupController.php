<?php

namespace App\Http\Controllers\Groups;

use App\DTOs\GroupDTO;
use App\DTOs\GroupFilterDTO;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Groups\Requests\IndexGroupRequest;
use App\Http\Controllers\Groups\Requests\StoreGroupRequest;
use App\Http\Controllers\Groups\Requests\UpdateGroupRequest;
use App\Models\Group;
use App\Services\Courses\CourseService;
use App\Services\Years\YearService;
use App\Services\Groups\GroupService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GroupController extends Controller
{
    /** @var GroupService  */
    private $service;

    public function __construct(GroupService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexGroupRequest $request
     * @return View
     */
    public function index(IndexGroupRequest $request): View
    {
        $DTO = GroupFilterDTO::fromArray($request->getFormData());
        $groups = $this->service->paginate($DTO);
        $titles = $this->service->getTableTitles();
        $filter = $DTO->toArray();

        return view('groups.index', compact('groups', 'titles', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param YearService $yearService
     * @return View
     */
    public function create(YearService $yearService, CourseService $courseService): View
    {
        $courses = $courseService->courseSelectList();
        $years = $yearService->educationYearSelectList();

        return view('groups.create', compact('courses', 'years'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreGroupRequest $request
     * @return RedirectResponse
     */
    public function store(StoreGroupRequest $request): RedirectResponse
    {
        $group = $this->service->store(GroupDTO::fromArray($request->getFormData()));

        return redirect()->route('groups.show', $group->id)
            ->with(['success' => __('messages.success_save')]);
    }

    /**
     * Display the specified resource.
     *
     * @param Group $group
     * @return View
     */
    public function show(Group $group): View
    {
        return view('groups.view', compact('group'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Group $group
     * @param YearService $yearService
     * @param CourseService $courseService
     * @return View
     */
    public function edit(Group $group, YearService $yearService, CourseService $courseService): View
    {
        $courses = $courseService->courseSelectList();
        $years = $yearService->educationYearSelectList();

        return view('groups.edit', compact('group', 'courses', 'years'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateGroupRequest $request
     * @param Group $group
     * @return RedirectResponse
     */
    public function update(UpdateGroupRequest $request, Group $group): RedirectResponse
    {
        $this->service->update(GroupDTO::fromArray($request->getFormData()), $group);

        return redirect()->route('groups.show', $group->id)
            ->with(['success' => __('messages.success_update')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Group $group
     * @return RedirectResponse
     */
    public function destroy(Group $group): RedirectResponse
    {
        $this->service->delete($group);

        return redirect()->route('groups.index')
            ->with(['success' => __('messages.success_delete')]);
    }
}
