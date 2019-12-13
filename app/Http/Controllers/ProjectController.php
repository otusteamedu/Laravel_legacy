<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Project::class);
    }

    protected function resourceAbilityMap()
    {
        $abilityMap = parent::resourceAbilityMap();
        $abilityMap['commits'] = 'view';
        return $abilityMap;
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $projects = Project::forUser($user)->get();
        return view('projects.index', compact('projects'));
    }

    public function create(Project $project)
    {
        return view('projects.create', compact('project'));
    }

    public function store(ProjectRequest $request)
    {
        $validated = $request->validated();

        $project = Project::create($validated);
        $project->users()->attach($request->user());

        return redirect(route('projects.show', $project));
    }

    public function show(Project $project)
    {
        return view('projects.dashboard', compact('project'));
    }

    public function commits(Project $project)
    {
        return view('projects.commits', compact('project'));
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $validated = $request->validated();

        $project->update($validated);

        return redirect(route('projects.edit', compact('project')))
            ->with('success', trans('projects.save_success'));
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect(route('projects.index'))
            ->with('success', trans('projects.delete_success', ['git' => $project->git]));
    }

}
