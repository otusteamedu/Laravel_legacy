<?php


namespace Tests\Unit\Jobs;


use App\Jobs\PhpInsightsJob;
use App\Models\Commit;
use App\Services\PhpInsightsService;
use Tests\TestCase;

class PhpInsightsJobTest extends TestCase
{
    public function testHandle()
    {
        $commit = new Commit();
        $sourceDir = 'dummy_dir';
        $projectId = random_int(1, 100);

        $phpInsightsService = \Mockery::mock(PhpInsightsService::class);
        $phpInsightsService->shouldReceive('exec')->with($commit, $sourceDir, $projectId);

        $job = new PhpInsightsJob($commit, $sourceDir, $projectId);
        $job->handle($phpInsightsService);
    }
}
