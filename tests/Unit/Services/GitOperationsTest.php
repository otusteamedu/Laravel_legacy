<?php

namespace Tests\Services;

use App\Services\GitOperations;
use Tests\TestCase;

class GitOperationsTest extends TestCase
{
    public function testClone()
    {
        /** @var GitOperations $gitOperations */
        $gitOperations = resolve(GitOperations::class);

        // Try to clone this project itself
        $repository = app()->basePath();
        $sourceDir = $gitOperations->clone($repository);

        $this->assertDirectoryExists($sourceDir . "/.git");

        // Remove temporary created directory
        $gitOperations->cleanupSourceDir($sourceDir);
    }

    public function testCleanupSeourceDir()
    {
        /** @var GitOperations $gitOperations */
        $gitOperations = resolve(GitOperations::class);

        $testDir = sys_get_temp_dir() . '/' . time();
        mkdir($testDir);

        // Remove temporary created directory
        $gitOperations->cleanupSourceDir($testDir);
        $this->assertDirectoryNotExists($testDir);
    }

    public function testGetCommitInfo()
    {
        /** @var GitOperations $gitOperations */
        $gitOperations = resolve(GitOperations::class);

        $commitInfo = $gitOperations->getCommitInfo(app()->basePath());
        $this->assertNotEmpty($commitInfo);
    }
}
