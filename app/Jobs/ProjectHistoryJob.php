<?php

namespace App\Jobs;

use App\Helpers\UrlHelpers;
use App\Models\Project;
use App\Services\CommitService;
use App\Services\GitOperations;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProjectHistoryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private const DEFAULT_DEPTH = 50;

    /**
     * @var Project
     */
    private $project;
    /**
     * @var int
     */
    private $depth;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Project $project, int $depth = self::DEFAULT_DEPTH)
    {
        $this->project = $project;
        $this->depth = $depth;
    }

    public function handle(GitOperations $gitOperations, CommitService $commitService)
    {
        if (!UrlHelpers::isValidRepositoryUrl($this->project->url)) {
            return;
        }

        $sourceDir = $gitOperations->clone($this->project->url, $this->depth);

        foreach ($gitOperations->checkoutParentIterator($sourceDir, $this->depth) as $_) {

            // Create or find Commit record based on Git Source Code and current Repository record
            $commit = $commitService->storeCommitFromSource($sourceDir, $this->project->repository_id);

            // Clone source tree into separate directory
            $separateSourceDirForThisCommit = $gitOperations->clone($sourceDir);

            // Run jobs for async analyze
            PhpLocJob::dispatch($commit, $separateSourceDirForThisCommit, $this->project->id);
            PhpInsightsJob::dispatch($commit, $separateSourceDirForThisCommit, $this->project->id);

        }

    }
}
