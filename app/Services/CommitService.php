<?php


namespace App\Services;


use App\Models\Commit;
use App\ValueObjects\CommitInfo;

class CommitService
{
    /**
     * @var GitOperations
     */
    private $gitOperations;

    public function __construct(GitOperations $gitOperations)
    {
        $this->gitOperations = $gitOperations;
    }

    public function firstOrCreate(CommitInfo $commitInfo, int $repositoryId): ?Commit
    {
        return Commit::firstOrCreate(
            ['repository_id' => $repositoryId, 'hash' => $commitInfo->hash],
            [
                'author' => $commitInfo->author,
                'commit_datetime' => $commitInfo->commitDateTime,
                'summary' => $commitInfo->summary,
            ]
        );
    }

    public function storeCommitFromSource(string $sourceDir, int $repositoryId): Commit
    {
        $commitInfo = $this->gitOperations->getCommitInfo($sourceDir);
        return $this->firstOrCreate($commitInfo, $repositoryId);
    }
}
