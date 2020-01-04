<?php

namespace Tests\Unit\Services;

use App\Models\Commit;
use App\Models\InsightsMetric;
use App\Models\Project;
use App\Services\PhpInsightsService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\MocksTrait;
use Tests\TestCase;

class PhpInsightsServiceTest extends TestCase
{
    use MocksTrait, RefreshDatabase;

    public function testExecForProject()
    {
        /** @var Commit $commit */
        $commit = factory(Commit::class)->create();
        /** @var Project $project */
        $project = factory(Project::class)->create(['repository_id' => $commit->repository_id]);

        $summary = $this->mockPhpInsights();

        $phpInsightsService = resolve(PhpInsightsService::class);
        $phpInsightsService->exec($commit, 'dummy_dir', $project->id);

        /** @var InsightsMetric $insightsMetric */
        $insightsMetric = InsightsMetric::where([
            'project_id' => $project->id,
            'repository_id' => $commit->repository_id,
            'commit_id' => $commit->id,
        ])->first();

        $this->assertEquals($summary['code'], $insightsMetric->code);
        $this->assertEquals($summary['complexity'], $insightsMetric->complexity);
        $this->assertEquals($summary['architecture'], $insightsMetric->architecture);
        $this->assertEquals($summary['style'], $insightsMetric->style);
        $this->assertEquals($summary['security_issues'], $insightsMetric->security_issues);
    }

    public function testExecFromLanding()
    {
        /** @var Commit $commit */
        $commit = factory(Commit::class)->create();

        $summary = $this->mockPhpInsights();

        $phpInsightsService = resolve(PhpInsightsService::class);
        $phpInsightsService->exec($commit, 'dummy_dir', null);

        /** @var InsightsMetric $insightsMetric */
        $insightsMetric = InsightsMetric::where([
            'project_id' => null,
            'repository_id' => $commit->repository_id,
            'commit_id' => $commit->id,
        ])->first();

        $this->assertEquals($summary['code'], $insightsMetric->code);
        $this->assertEquals($summary['complexity'], $insightsMetric->complexity);
        $this->assertEquals($summary['architecture'], $insightsMetric->architecture);
        $this->assertEquals($summary['style'], $insightsMetric->style);
        $this->assertEquals($summary['security_issues'], $insightsMetric->security_issues);
    }
}
