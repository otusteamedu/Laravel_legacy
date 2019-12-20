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
        $storagePath = $gitOperations->clone($repository);

        $this->assertDirectoryExists(\Storage::path($storagePath) . "/.git");

        // Remove temporary created directory
        \Storage::deleteDirectory($storagePath);
    }
}
