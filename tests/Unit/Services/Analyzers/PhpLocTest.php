<?php

namespace Tests\Unit\Services\Analyzers;

use App\Models\LocMetric;
use App\Services\Analyzers\PhpLoc;
use App\Services\GitOperations;
use Tests\TestCase;

class PhpLocTest extends TestCase
{

    public function testRun()
    {
        /** @var GitOperations $gitOperations */
        $gitOperations = resolve(GitOperations::class);

        // Clone this project itself first
        $repository = app()->basePath();
        $sourceDir = $gitOperations->clone($repository);

        // Create PhpLoc analyzer instance against cloned repo
        $phpLoc = resolve(PhpLoc::class);
        $data = $phpLoc->run($sourceDir);

        $this->assertIsArray($data);

        // Get all known metrics from LocMetric::$fillable array - all of them must be in returned $data from PhpLoc
        $metricAttrs = $this->getMetricAttrs();
        foreach($metricAttrs as $attr) {
            $this->assertArrayHasKey($attr, $data);
        }

         $gitOperations->cleanupSourceDir($sourceDir);
    }

    protected function getMetricAttrs(): array
    {
        $locMetric = new LocMetric();
        $reflection = new \ReflectionClass($locMetric);
        $property = $reflection->getProperty('fillable');
        $property->setAccessible(true);
        $fillable = $property->getValue($locMetric);

        return array_diff($fillable, ['project_id', 'repository_id', 'commit_id']);
    }
}
