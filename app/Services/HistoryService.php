<?php


namespace App\Services;


use App\Models\InsightsMetric;
use App\Models\LocMetric;

class HistoryService
{
    private const DEFAULT_DEPTH = 3;

    const ANALYZE_PHPLOC = 0b01;
    const ANALYZE_PHPINSIGHTS = 0b10;

    const ANALYZE_ALL = self::ANALYZE_PHPLOC | self::ANALYZE_PHPINSIGHTS;

    /**
     * @var GitOperations
     */
    private $gitOperations;
    /**
     * @var CommitService
     */
    private $commitService;
    /**
     * @var PhpLocService
     */
    private $phpLocService;
    /**
     * @var PhpInsightsService
     */
    private $phpInsightsService;

    public function __construct(
        GitOperations $gitOperations,
        CommitService $commitService,
        PhpLocService $phpLocService,
    PhpInsightsService $phpInsightsService
    ) {
        $this->gitOperations = $gitOperations;
        $this->commitService = $commitService;
        $this->phpLocService = $phpLocService;
        $this->phpInsightsService = $phpInsightsService;
    }

    public function collectHistory(
        string $sourceDir,
        ?int $projectId,
        int $repositoryId,
        int $analyzers = self::ANALYZE_ALL,
        int $depth = self::DEFAULT_DEPTH
    ) {

        foreach ($this->gitOperations->checkoutParentIterator($sourceDir, $depth) as $_) {

            // Create or find Commit record based on Git Source Code and current Repository record
            $commit = $this->commitService->storeCommitFromSource($sourceDir, $repositoryId);

            if ($analyzers & self::ANALYZE_PHPLOC) {
                // Execute PHPLOC analyzer
                try {
                    $this->phpLocService->exec($commit, $sourceDir, $projectId);
                } catch (\Exception $e) {
                    report($e);
                }
            }

            if ($analyzers & self::ANALYZE_PHPINSIGHTS) {
                // Execute PHPLOC analyzer
                try {
                    $this->phpInsightsService->exec($commit, $sourceDir, $projectId);
                } catch (\Exception $e) {
                    report($e);
                }
            }

        }

    }

    /**
     * @param int $repositoryId
     * @param int|null $projectId
     * @param int $depth
     * @return \Illuminate\Support\Collection
     */
    public function loadLocHistory(int $repositoryId, ?int $projectId, int $depth = self::DEFAULT_DEPTH)
    {
        return LocMetric::where([
            'loc_metrics.repository_id' => $repositoryId,
            'loc_metrics.project_id' => $projectId,
        ])
            ->join('commits', 'commits.id', '=', 'loc_metrics.commit_id')
            ->orderBy('commits.commit_datetime')
            ->select([
                'loc_metrics.loc',
                'loc_metrics.files',
                'commits.author',
                'commits.commit_datetime',
                'commits.summary',
                'commits.hash',
            ])
            ->limit($depth)
            ->get()
            ->reverse()
            ->values();
    }

    /**
     * @param int $repositoryId
     * @param int|null $projectId
     * @param int $depth
     * @return \Illuminate\Support\Collection
     */
    public function loadInsightsHistory(int $repositoryId, ?int $projectId, int $depth = self::DEFAULT_DEPTH)
    {
        return InsightsMetric::where([
            'insights_metrics.repository_id' => $repositoryId,
            'insights_metrics.project_id' => $projectId,
        ])
            ->join('commits', 'commits.id', '=', 'insights_metrics.commit_id')
            ->orderBy('commits.commit_datetime')
            ->select([
                'insights_metrics.code',
                'insights_metrics.complexity',
                'insights_metrics.architecture',
                'insights_metrics.style',
                'insights_metrics.security_issues',
                'commits.author',
                'commits.commit_datetime',
                'commits.summary',
                'commits.hash',
            ])
            ->limit($depth)
            ->get()
            ->reverse()
            ->values();
    }
}
