<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Cms\Projects\Requests\ProjectStoreRequest;
use App\Http\Controllers\Cms\Requests\ProjectUpdateRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectCollection;
use App\Http\Resources\Project as ProjectResource;
use App\Jobs\ProjectUpdate;
use App\Models\Project;
use App\Services\Projects\ProjectsService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $projectsService;

    public function __construct(ProjectsService $projectsService)
    {
        $this->projectsService = $projectsService;
    }

    public function index()
    {
        $data = $this->projectsService->getAll(config('paginate_api.projects'));
        return new ProjectCollection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectStoreRequest $request)
    {
        $data = $request->all();
        $result = $this->projectsService->saveForm($data);
        return new ProjectResource($result);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->projectsService->getProject($id);
        return new ProjectResource($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectUpdateRequest $request, Project $project)
    {
        $data = $request->all();
        $result = $this->projectsService->updateForm($project, $data);
        return new ProjectResource($project);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $result = $this->projectsService->delForm($project->id);
        return new ProjectResource($project);
    }
}
