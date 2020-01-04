<?php


namespace App\Services;


use App\Exceptions\AnalyzerException;
use App\Exceptions\UrlParseException;
use App\Models\Commit;
use App\Models\Project;
use App\Models\Run;
use App\Models\User;
use App\ValueObjects\RepositoryUrl;

class RunService
{
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
    /**
     * @var RepositoryService
     */
    private $repositoryService;


    public function __construct(
        CommitService $commitService,
        RepositoryService $repositoryService,
        PhpLocService $phpLocService,
        PhpInsightsService $phpInsightsService
    ) {
        $this->commitService = $commitService;
        $this->repositoryService = $repositoryService;
        $this->phpLocService = $phpLocService;
        $this->phpInsightsService = $phpInsightsService;
    }

    public function createRunForProject(Project $project, User $user, $ip)
    {
        $data = [
            'ip' => $ip,
            'url' => $project->url,
            'user_id' => $user->id,
        ];

        $run = Run::make($data);
        $run->project()->associate($project);
        $run->repository()->associate($project->repository_id);
        $run->save();

        return $run;
    }

    /**
     * Used from Landing page
     *
     * @param string $requestedUrl
     * @param User|null $user
     * @param $ip
     * @return Run|\Illuminate\Database\Eloquent\Model
     */
    public function createRunForUrl(string $requestedUrl, ?User $user, $ip)
    {
        $data = [
            'ip' => $ip,
            'url' => $requestedUrl,
        ];

        if ($user) {
            $data['user_id'] = $user->id;
        }

        $run = Run::create($data);

        // Try to link with repository by provided url
        try {

            // Create valid value-object (may throw if url is invalid)
            $url = new RepositoryUrl($run->url);

            $repository = $this->repositoryService->firstOrCreate($url);
            $run->repository()->associate($repository);

        } catch (UrlParseException $e) {
            // Just do nothing if url is invalid (do not link to repository record)
        }

        return $run;
    }

    public function exec(Run $run, string $sourceDir)
    {
        $commit = $this->createCommit($run, $sourceDir);

        try {
            $this->execPhpLoc($commit, $sourceDir, $run->project_id);
        } catch (AnalyzerException $e) {
            $run->error_phploc = $e->getMessage();
        }

        try {
            $this->execPhpInsights($commit, $sourceDir, $run->project_id);
        } catch (AnalyzerException $e) {
            $run->error_phpinsights = $e->getMessage();
        }

        $run->save();
    }

    protected function createCommit(Run $run, $sourceDir): Commit
    {
        // Create or find Commit record based on Git Source Code and current Repository record
        $commit = $this->commitService->storeCommitFromSource($sourceDir, $run->repository_id);
        $run->commit()->associate($commit);
        $run->save();

        return $commit;
    }

    protected function execPhpLoc(Commit $commit, string $sourceDir, ?int $projectId)
    {
        $this->phpLocService->exec($commit, $sourceDir, $projectId);
    }

    protected function execPhpInsights(Commit $commit, string $sourceDir, ?int $projectId)
    {
        $this->phpInsightsService->exec($commit, $sourceDir, $projectId);
    }
}
