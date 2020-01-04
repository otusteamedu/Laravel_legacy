<?php


namespace App\Services;


use App\Exceptions\AnalyzerException;
use App\Models\Commit;
use App\Models\LocMetric;
use App\Services\Analyzers\PhpLoc;

class PhpLocService
{
    /**
     * @var PhpLoc
     */
    private $phpLoc;

    public function __construct(PhpLoc $phpLoc)
    {
        $this->phpLoc = $phpLoc;
    }

    public function exec(Commit $commit, string $sourceDir, int $projectId = null)
    {
        // For public runs ($projectId === null) we can skipp analyzer if metric has been already collected
        // but for concrete projects we always rerun analyzer, because project settings could have been changed
        if (!$projectId && $this->isPublicMetricExists($commit)) {
            return;
        }

        // Run PHPLOC for this commit
        $result = $this->phpLoc->run($sourceDir);
        // Store result of PHPLOC run into database for this commit
        $this->store($commit->id, $commit->repository_id, $result, $projectId);
    }

    protected function store(int $commitId, int $repositoryId, array $result, ?int $projectId)
    {
        $locMetric = LocMetric::firstOrNew([
            'project_id' => $projectId,
            'repository_id' => $repositoryId,
            'commit_id' => $commitId,
        ]);
        $locMetric->fill($result);
        $locMetric->save();
    }

    protected function isPublicMetricExists(Commit $commit): bool
    {
        return LocMetric::where(['commit_id' => $commit->id, 'project_id' => null])->exists();
    }
}
