<?php

namespace Tests\Unit\Services;

use App\Models\Repository;
use App\Services\CommitService;
use App\ValueObjects\CommitInfo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class CommitServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testFirstOrCreate()
    {
        $commitService = resolve(CommitService::class);

        $repository = factory(Repository::class)->create();
        $commitInfo = new CommitInfo(Str::random(40), 'author', now(), 'summary');

        $commit = $commitService->firstOrCreate($commitInfo, $repository->id);
        $this->assertEquals($commitInfo->hash, $commit->hash);
        $this->assertEquals($commitInfo->author, $commit->author);
        $this->assertEquals($commitInfo->commitDateTime->format('Y-m-d H:i:s'), $commit->commit_datetime->format('Y-m-d H:i:s'));
        $this->assertEquals($commitInfo->summary, $commit->summary);

        $commit2 = $commitService->firstOrCreate($commitInfo, $repository->id);
        $this->assertEquals($commit->id, $commit2->id);
    }
}
