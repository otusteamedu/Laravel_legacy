<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Jobs\ProjectAnalyzeJob;
use App\Jobs\ProjectHistoryJob;
use App\Models\Project;
use App\Services\HistoryService;
use App\Services\ProjectService;
use App\Services\RunService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    private const HISTORY_DEPTH_TO_RENDER = 50;

    /**
     * @var ProjectService
     */
    private $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->authorizeResource(Project::class);
        $this->projectService = $projectService;
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

        $project = $this->projectService->createFromArray($validated, $request->user());

        // When creating a new Project, collect PHPLOC history for last 50 commits
        ProjectHistoryJob::dispatch($project);

        return redirect(route('projects.show', $project));
    }

    public function show(Project $project, HistoryService $phpLocHistoryService)
    {
        $locHistory = [];
        $insightsHistory = [];

        if ($project->repository_id) {
            $locHistory = $phpLocHistoryService->loadLocHistory(
                $project->repository_id,
                $project->id,
                self::HISTORY_DEPTH_TO_RENDER
            );

            $insightsHistory = $phpLocHistoryService->loadInsightsHistory(
                $project->repository_id,
                $project->id,
                self::HISTORY_DEPTH_TO_RENDER
            );
        }
        return view('projects.dashboard', compact('project', 'locHistory', 'insightsHistory'));
    }

    public function commits(Project $project)
    {
        $commits = $this->projectService->loadCommitsWithPaginate($project);
        return view('projects.commits', compact('project', 'commits'));
    }

    public function commitShow(Project $project, string $hash)
    {
        $commit = $this->projectService->loadCommit($project, $hash);
        if (!$commit) {
            return redirect(route('projects.commits', $project))
                ->with('error', trans('projects.error_commit_not_found'));
        }

        $insightsMetric = $this->projectService->loadInsightsMetric($project, $commit);
        $locMetric = $this->projectService->loadLocMetric($project, $commit);

        return view('projects.commit', compact('project', 'commit', 'insightsMetric', 'locMetric'));
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $validated = $request->validated();

        $oldRepositoryId = $project->repository_id;

        $this->projectService->updateFromArray($project, $validated);

        $newRepositoryId = $project->repository_id;

        if ($oldRepositoryId !== $newRepositoryId) {
            // When updating a Project URL, collect PHPLOC history for last 50 commits
            ProjectHistoryJob::dispatch($project);
        }

        return redirect(route('projects.edit', compact('project')))
            ->with('success', trans('projects.save_success'));
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect(route('projects.index'))
            ->with('success', trans('projects.delete_success', ['url' => $project->url]));
    }

    public function analyze(Project $project, RunService $runService, Request $request)
    {
        $run = $runService->createRunForProject($project, $request->user(), $request->ip());
        ProjectAnalyzeJob::dispatch($run);

        return redirect(route('projects.show', $project))
            ->with('success', trans('projects.analyze_queued'));
    }

}
