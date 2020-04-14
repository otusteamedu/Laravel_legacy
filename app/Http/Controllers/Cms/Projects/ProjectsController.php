<?php

namespace App\Http\Controllers\Cms\Projects;

use App\Http\Controllers\Cms\Projects\Requests\StoreProjectRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Cms\Projects\Requests\StoreCityRequest;
use App\Models\Segment;
use App\Models\Tariff;
use App\Models\Project;
use App\Models\User;
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
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('cms.projects.index', ['projects' => Project::paginate()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        if (Gate::allows('create-project')) {
            $users = User::all();

            return view('cms.projects.create', [
                'users' => $users,
            ]);
        }else{
            return view('errors.not-allowed');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreProjectRequest $request)
    {
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

        return redirect(route('cms.projects.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Project $project)
    {
        return view('cms.projects.show', [
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
        if (Gate::allows('update-project')) {
            return view('cms.projects.edit', [
                'project' => $project,
            ]);
        }else{
            return view('errors.not-allowed');
        }
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
            $this->projectsService->updateProject($project, $request->all());
            $project->update($request->all());
        } catch (\Exception $e) {
            \Log::channel('slack-critical')->critical(__METHOD__ . ': ' . $e->getMessage());
            return response()->json([
                'message' => 'Update project error',
                'errors' => [[$e->getMessage()]],
            ]);
        }

        return redirect(route('cms.projects.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
