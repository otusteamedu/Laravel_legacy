<?php


namespace App\Services;


use App\Models\Commit;
use App\Models\InsightsMetric;
use App\Services\Analyzers\PhpInsights;

class PhpInsightsService
{
    /**
     * @var PhpInsights
     */
    private $phpInsights;

    public function __construct(PhpInsights $phpInsights)
    {
        $this->phpInsights = $phpInsights;
    }

    public function exec(Commit $commit, string $sourceDir, ?int $projectId)
    {
        // For public runs ($projectId === null) we can skipp analyzer if metric has been already collected
        // but for concrete projects we always rerun analyzer, because project settings could have been changed
        if (!$projectId && $this->isPublicMetricExists($commit)) {
            return true;
        }

        // Run PHP Insights for this commit
        $result = $this->phpInsights->run($sourceDir);
        // Store result into database for this commit and this project
        $this->store($commit->id, $commit->repository_id, $result, $projectId);
        return true;
    }

    protected function store(int $commitId, int $repositoryId, array $result, ?int $projectId)
    {
        $insightsMetric = InsightsMetric::firstOrNew([
            'project_id' => $projectId,
            'repository_id' => $repositoryId,
            'commit_id' => $commitId,
        ]);
        $insightsMetric->fill($result['summary']);
        $insightsMetric->save();
    }

    protected function isPublicMetricExists(Commit $commit): bool
    {
        return InsightsMetric::where([
            'project_id' => null,
            'repository_id' => $commit->repository_id,
            'commit_id' => $commit->id,
        ])->exists();
    }
}
