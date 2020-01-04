<?php


namespace App\Services;


use App\Exceptions\UrlParseException;
use App\Helpers\UrlHelpers;
use App\Models\Commit;
use App\Models\InsightsMetric;
use App\Models\LocMetric;
use App\Models\Project;
use App\Models\Repository;
use App\Models\User;

class ProjectService
{
    public function createFromArray(array $data, User $user): Project
    {
        $project = Project::create($data);
        $project->users()->attach($user);

        $this->associateWithRepository($project);

        return $project;
    }

    public function updateFromArray(Project $project, array $data): Project
    {
        $project->update($data);
        $this->associateWithRepository($project);

        return $project;
    }

    protected function associateWithRepository(Project $project)
    {
        try {
            $normalizedUrl = UrlHelpers::normalizeRepositryUrl($project->url);
        } catch (UrlParseException $e) {
            // Invalid url - unlink from repository (if any)
            $project->repository()->dissociate();
            $project->save();
            return;
        }

        $repository = Repository::firstOrCreate(
            ['normalized_url' => $normalizedUrl],
            ['url' => $project->url],
            );

        $project->repository()->associate($repository);
        $project->save();
    }

    public function loadCommitsWithPaginate(Project $project)
    {
        return Commit::forProject($project)->orderBy('commit_datetime', 'desc')->paginate();
    }

    public function loadCommit(Project $project, string $hash): ?Commit
    {
        return Commit::where([
            'repository_id' => $project->repository_id,
            'hash' => $hash,
        ])->first();
    }

    public function loadLocMetric(Project $project, Commit $commit): ?LocMetric
    {
        return LocMetric::where([
            'project_id' => $project->id,
            'commit_id' => $commit->id,
        ])->first();
    }

    public function loadInsightsMetric(Project $project, Commit $commit): ?InsightsMetric
    {
        return InsightsMetric::where([
            'project_id' => $project->id,
            'commit_id' => $commit->id,
        ])->first();
    }
}
