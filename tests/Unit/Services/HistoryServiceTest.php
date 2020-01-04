<?php


namespace Tests\Unit\Services;


use App\Models\LocMetric;
use App\Models\Repository;
use App\Services\GitOperations;
use App\Services\HistoryService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\MocksTrait;
use Tests\TestCase;

class HistoryServiceTest extends TestCase
{
    use MocksTrait, RefreshDatabase;

    public function testCollectHistory()
    {
        $this->mockPhpLoc();
        $this->mockPhpInsights();

        $historyService = resolve(HistoryService::class);

        $gitOperations = resolve(GitOperations::class);

        $depth = 3;
        $sourceDir = $gitOperations->clone(app()->basePath(), $depth);

        $repository = factory(Repository::class)->create();

        $historyService->collectHistory($sourceDir, null, $repository->id, HistoryService::ANALYZE_ALL, $depth);

        $this->assertEquals($depth, LocMetric::count());

        $gitOperations->cleanupSourceDir($sourceDir);
    }
}
