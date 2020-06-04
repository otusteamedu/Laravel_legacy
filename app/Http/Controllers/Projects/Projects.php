<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Projects\Requests\StoreProjectRequest;
use App\Http\Controllers\Projects\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Services\Projects\ProjectsService;
use Illuminate\Http\Request;

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
        $list = $this->projectsService->searchProjects();

        return view('projects.index')->with([
            'user'        => ['id' => 1], // @todo
            'list'        => $list,
            'currentPage' => 'projects',
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
        return view('projects.create')->with([
            'user'        => ['id' => 1], // @todo
            'currentPage' => 'projects',
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
        $this->projectsService->storeProject($request->getFormData());

        return redirect(route('projects.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $project = $this->projectsService->findProject($id);

        // @todo передать список тикетов

        return view('projects.show')->with([
            'user'        => ['id' => 1], // @todo
            'currentPage' => 'projects',
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
        return view('projects.edit')->with([
            'user' => ['id' => 1], // @todo
            'project' => $project,
            'currentPage' => 'projects',
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

        $this->projectsService->deleteProject($project);

        return redirect(route('projects.index'));
    }
}
