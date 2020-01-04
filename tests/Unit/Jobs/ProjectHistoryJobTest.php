<?php


namespace Tests\Unit\Jobs;


use App\Jobs\PhpInsightsJob;
use App\Jobs\PhpLocJob;
use App\Jobs\ProjectHistoryJob;
use App\Models\Commit;
use App\Services\CommitService;
use App\Services\GitOperations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\Generators\ProjectGenerator;
use Tests\TestCase;

class ProjectHistoryJobTest extends TestCase
{
    use RefreshDatabase;

    public function testHandle()
    {
        Queue::fake();

        $project = ProjectGenerator::createWithLocalGitRepo();
        $gitOperations = resolve(GitOperations::class);
        $commitService = resolve(CommitService::class);

        $depth = 3;

        $historyJob = new ProjectHistoryJob($project, $depth);
        $historyJob->handle($gitOperations, $commitService);

        // Assert that commits were stored in database
        $this->assertGreaterThanOrEqual($depth, Commit::count());

        // As a result new jobs to be dispatched for each commit (so $depth times)
        Queue::assertPushed(PhpLocJob::class, $depth);
        Queue::assertPushed(PhpInsightsJob::class, $depth);
    }
}
