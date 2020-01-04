<?php


namespace Tests\Unit\Jobs;


use App\Jobs\PhpLocJob;
use App\Models\Commit;
use App\Services\PhpLocService;
use Tests\TestCase;

class PhpLocJobTest extends TestCase
{
    public function testHandle()
    {
        $commit = new Commit();
        $sourceDir = 'dummy_dir';
        $projectId = random_int(1, 100);

        $phpLocService = \Mockery::mock(PhpLocService::class);
        $phpLocService->shouldReceive('exec')->with($commit, $sourceDir, $projectId);

        $job = new PhpLocJob($commit, $sourceDir, $projectId);
        $job->handle($phpLocService);
    }
}
