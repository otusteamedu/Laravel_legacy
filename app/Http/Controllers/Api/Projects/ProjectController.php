<?php

namespace App\Http\Controllers\Api\Projects;

use App\Builders\QueryBuilder;
use App\Http\Controllers\Api\Projects\Requests\ProjectListRequest;
use App\Http\Controllers\Api\Projects\Requests\ProjectSaveRequest;
use App\Http\Controllers\Api\Projects\Resources\ProjectResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\Projects\Resources\ProjectCollectionResource;
use App\Models\Project;
use App\Services\Projects\ProjectsService;

class ProjectController extends Controller
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
     * @param ProjectListRequest $request
     *
     * @return ProjectCollectionResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(ProjectListRequest $request)
    {
        $this->authorize('project.viewAny');

        $builder = new QueryBuilder();
        $builder->setLimit($request->getLimit())->setOffset($request->getOffset());

        $collection = $this->projectsService->getAll($builder);

        $resource = new ProjectCollectionResource($collection);
        $resource->with['total'] = $builder->getTotal();

        return $resource;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProjectSaveRequest $request
     *
     * @return ProjectResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(ProjectSaveRequest $request)
    {
        $this->authorize('project.create');

        $project = $this->projectsService->storeProject($request->toArray());

        return new ProjectResource($project);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Project $project
     *
     * @return ProjectResource|\Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Project $project)
    {
        $this->authorize('project.view', $project);

        return new ProjectResource($project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProjectSaveRequest  $request
     * @param \App\Models\Project $project
     *
     * @return ProjectResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(ProjectSaveRequest $request, Project $project)
    {
        $this->authorize('project.update', $project);

        $project = $this->projectsService->updateProject($project, $request->toArray());

        return new ProjectResource($project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Project $project
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Project $project)
    {
        $this->authorize('project.delete', $project);

        $this->projectsService->deleteProject($project);

        return response()->json(['status' => 'ok']);
    }
}
