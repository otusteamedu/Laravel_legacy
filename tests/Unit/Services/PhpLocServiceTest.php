<?php

namespace Tests\Unit\Services;

use App\Models\Commit;
use App\Models\LocMetric;
use App\Models\Project;
use App\Services\PhpLocService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\MocksTrait;
use Tests\TestCase;

class PhpLocServiceTest extends TestCase
{
    use MocksTrait, RefreshDatabase;

    public function testExecForProject()
    {
        /** @var Commit $commit */
        $commit = factory(Commit::class)->create();
        /** @var Project $project */
        $project = factory(Project::class)->create(['repository_id' => $commit->repository_id]);

        $locData = $this->mockPhpLoc();

        $phpLocService = resolve(PhpLocService::class);
        $phpLocService->exec($commit, 'dummy_dir', $project->id);

        /** @var LocMetric $locMetric */
        $locMetric = LocMetric::where([
            'project_id' => $project->id,
            'repository_id' => $commit->repository_id,
            'commit_id' => $commit->id,
        ])->first();

        foreach ($locData as $metricKey => $metricValue) {
            $this->assertEquals($locData[$metricKey], $locMetric->{$metricKey});
        }
    }

    public function testExecFromLanding()
    {
        /** @var Commit $commit */
        $commit = factory(Commit::class)->create();

        $locData = $this->mockPhpLoc();

        $phpLocService = resolve(PhpLocService::class);
        $phpLocService->exec($commit, 'dummy_dir', null);

        /** @var LocMetric $locMetric */
        $locMetric = LocMetric::where([
            'project_id' => null,
            'repository_id' => $commit->repository_id,
            'commit_id' => $commit->id,
        ])->first();

        foreach ($locData as $metricKey => $metricValue) {
            $this->assertEquals($locData[$metricKey], $locMetric->{$metricKey});
        }
    }
}
