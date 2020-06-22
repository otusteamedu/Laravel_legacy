<?php

namespace App\Http\Controllers\Cms\Projects;

use App\Http\Controllers\Cms\Projects\Requests\StoreProjectRequest;
use App\Http\Controllers\Cms\Projects\Requests\UpdateProjectRequest;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use App\Policies\Abilities;
use App\Services\Projects\ProjectsService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
    /**
     * @var ProjectsService
     */
    protected $projectsService;
    protected $currentUser;

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
     * @param User $user
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Project $project, User $user)
    {
        $this->authorize(Abilities::VIEW, $project);

        if ($user->isAdmin()){
            $projects = Project::paginate();
        }else{
            $projects = Project::where('user_id', '=', $user->getId())->paginate();
        }

        return view('cms.projects.index', [
            'projects' => $projects
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Project $project
     * @param User $user
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Project $project, User $user)
    {
        $this->authorize(Abilities::CREATE, $project);

        if ($user->isAdmin())
            $users = User::all()->pluck('name', 'id')->toArray();
        else
            $users = $user->getCurrentUserDataArray();

        return view(config('view.cms.projects.create'), [
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
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
     * @param \App\Models\Project $project
     * @param User $user
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Project $project, User $user)
    {
        $this->authorize(Abilities::VIEW, $project);

        if ($user->isAdmin())
            $users = User::all()->pluck('name', 'id')->toArray();
        else
            $users = $user->getCurrentUserDataArray();

        return view(config('view.cms.projects.edit'), [
            'project' => $project,
            'users' => $users,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Project $project
     * @param User $user
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Project $project, User $user)
    {
        $this->authorize(Abilities::UPDATE, $project);

        if ($user->isAdmin())
            $users = User::all()->pluck('name', 'id')->toArray();
        else
            $users = $user->getCurrentUserDataArray();

        return view(config('view.cms.projects.edit'), [
            'project' => $project,
            'users' => $users,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProjectRequest $request
     * @param \App\Models\Project $project
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $this->authorize(Abilities::UPDATE, $project);

        $data = $request->getFormData();

        try {
            $project->update($data);
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
