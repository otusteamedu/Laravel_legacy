<?php

namespace App\Jobs;

use App\Models\Commit;
use App\Services\PhpLocService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class PhpLocJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Commit
     */
    private $commit;
    /**
     * @var string
     */
    private $sourceDir;
    /**
     * @var int
     */
    private $projectId;

    public function __construct(Commit $commit, string $sourceDir, int $projectId)
    {
        $this->commit = $commit;
        $this->sourceDir = $sourceDir;
        $this->projectId = $projectId;
    }

    public function handle(PhpLocService $phpLocService)
    {
        $phpLocService->exec($this->commit, $this->sourceDir, $this->projectId);
    }
}
