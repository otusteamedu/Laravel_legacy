<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Projects\Requests\StoreProjectRequest;
use App\Http\Controllers\Projects\Requests\UpdateProjectRequest;
use App\Services\Projects\ProjectsService;

class Projects extends Controller
{

    /**
     * @var ProjectsService
     */
    private $projectsService;

    public function __construct(ProjectsService $projectsService)
    {
        $this->projectsService = $projectsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('project.viewAny');

        $list = $this->projectsService->searchProjects();

        return view('projects.index')->with([
            'list'        => $list,
            'title'       => __("projects/general.title"),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('project.create');

        return view('projects.create')->with([
            'title'       => __("projects/create.title"),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProjectRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreProjectRequest $request)
    {
        $this->authorize('project.create');

        $this->projectsService->storeProject($request->getFormData());

        return redirect(route('projects.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show(int $id)
    {
        $project = $this->projectsService->findProject($id);

        if (!$project) {
            abort(404);
        }

        $this->authorize('project.view', $project);

        // @todo передать список тикетов

        return view('projects.show')->with([
            'project'     => $project,
            'title'       => $project->name,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit(int $id)
    {
        $project = $this->projectsService->findProject($id);

        if (!$project) {
            abort(404);
        }

        $this->authorize('project.update', $project);

        return view('projects.edit')->with([
            'project' => $project,
            'title' => __("projects/edit.title")
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProjectRequest $request
     * @param int                  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateProjectRequest $request, $id)
    {
        $project = $this->projectsService->findProject($id);

        if (!$project) {
            abort(404);
        }

        $this->authorize('project.update', $project);

        $this->projectsService->updateProject($project, $request->getFormData());

        return redirect(route('projects.show', ['project' => $project->id]));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $project = $this->projectsService->findProject($id);

        if (!$project) {
            abort(404);
        }

        $this->authorize('project.delete', $project);

        $this->projectsService->deleteProject($project);

        return redirect(route('projects.index'));
    }
}
