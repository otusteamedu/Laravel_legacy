<?php

namespace App\Http\Controllers\Cms\Projects;

use App\Http\Controllers\Cms\Projects\Requests\StoreProjectRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Cms\Projects\Requests\StoreCityRequest;
use App\Models\Segment;
use App\Models\Tariff;
use App\Models\Project;
use App\Models\User;
use App\Policies\Abilities;
use App\Services\Projects\ProjectsService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use View;


class ProjectsController extends Controller
{
    /**
     * @var ProjectsService
     */
    protected $projectsService;

    public function __construct(
        ProjectsService $projectsService
    )
    {
        $this->projectsService = $projectsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Project $project
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Project $project)
    {
        $this->authorize(Abilities::VIEW, $project);

        return view('cms.projects.index', [
            'projects' => Project::paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Project $project
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Project $project)
    {
        $this->authorize(Abilities::CREATE, $project);

        $users = User::all();

        return view(config('view.cms.projects.create'), [
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProjectRequest $request
     * @param Project $project
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreProjectRequest $request, Project $project)
    {
        $this->authorize(Abilities::CREATE, $project);

        $data = $request->getFormData();

        try {
            $this->projectsService->storeProject($data);
        } catch (\Exception $e) {
            \Log::channel('slack-critical')->critical(__METHOD__ . ': ' . $e->getMessage());
            return response()->json([
                'message' => 'Store project error',
                'errors' => [[$e->getMessage()]],
            ]);
        }

        return redirect(route(config('view.cms.projects.index')));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Project $project)
    {
        $this->authorize(Abilities::VIEW, $project);

        return view(config('view.cms.projects.edit'), [
            'project' => $project,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Project $project)
    {
        $this->authorize(Abilities::UPDATE, $project);

        return view(config('view.cms.projects.edit'), [
            'project' => $project,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Project $project)
    {
        $this->authorize(Abilities::UPDATE, $project);

        try {
            //$this->projectsService->updateProject($project, $request->all());
            $project->update($request->all());
        } catch (\Exception $e) {
            \Log::channel('slack-critical')->critical(__METHOD__ . ': ' . $e->getMessage());
            return response()->json([
                'message' => 'Update project error',
                'errors' => [[$e->getMessage()]],
            ]);
        }

        return redirect(route(config('view.cms.projects.index')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        return false;
    }
}
