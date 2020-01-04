<?php


namespace Tests;


use App\Models\InsightsMetric;
use App\Models\LocMetric;
use App\Services\Analyzers\PhpInsights;
use App\Services\Analyzers\PhpLoc;

trait MocksTrait
{
    protected function mockPhpInsights()
    {
        /** @var InsightsMetric $insightsMetric */
        $insightsMetric = factory(InsightsMetric::class)->make();
        $summary = $insightsMetric->getAttributes();

        $this->instance(PhpInsights::class, \Mockery::mock(PhpInsights::class, function ($mock) use ($summary) {
            /** @var $mock Mock */
            $mock->shouldReceive('run')->andReturn(['summary' => $summary]);
        }));

        return $summary;
    }

    protected function mockPhpLoc()
    {
        /** @var LocMetric $locMetric */
        $locMetric = factory(LocMetric::class)->make();
        $locData = $locMetric->getAttributes();

        $this->instance(PhpLoc::class, \Mockery::mock(PhpLoc::class, function ($mock) use ($locData) {
            /** @var $mock Mock */
            $mock->shouldReceive('run')->andReturn($locData);
        }));

        return $locData;
    }
}
