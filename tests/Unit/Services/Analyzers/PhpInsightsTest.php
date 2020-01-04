<?php

namespace Tests\Unit\Services\Analyzers;

use App\Services\Analyzers\PhpInsights;
use App\Services\GitOperations;
use Tests\TestCase;

class PhpInsightsTest extends TestCase
{
    public function testRun()
    {
        /** @var GitOperations $gitOperations */
        $gitOperations = resolve(GitOperations::class);

        // Clone this project itself first
        $repository = app()->basePath();
        $sourceDir = $gitOperations->clone($repository);

        // Create PhpInsights analyzer instance against cloned repo
        $phpInsigts = resolve(PhpInsights::class);
        $data = $phpInsigts->run($sourceDir);

        $this->assertIsArray($data['summary']);

        $summary = $data['summary'];
        $this->assertArrayHasKey('code', $summary);
        $this->assertArrayHasKey('complexity', $summary);
        $this->assertArrayHasKey('architecture', $summary);
        $this->assertArrayHasKey('style', $summary);
        $this->assertArrayHasKey('security_issues', $summary);

        $gitOperations->cleanupSourceDir($sourceDir);
    }
}
