<?php


namespace App\Services;


use App\ValueObjects\CommitInfo;
use GitWrapper\Exception\GitException;
use GitWrapper\GitWrapper;
use Symfony\Component\Process\Process;

class GitOperations
{
    private $workdir;

    /** @var GitWrapper */
    private $gitWrapper;

    public function __construct(string $gitBinary, string $workdir = null)
    {
        $this->gitWrapper = new GitWrapper($gitBinary);
        $this->workdir = $workdir ?? sys_get_temp_dir();
    }

    private function makeUniqueDirectory(): string
    {
        do {
            $uniqueDir = rtrim($this->workdir, '/') . '/' . time() . '_' . random_int(0, PHP_INT_MAX);
        } while (file_exists($uniqueDir));

        if (!mkdir($uniqueDir) && !is_dir($uniqueDir)) {
            throw new \Exception('Cant create dir ' . $uniqueDir);
        }

        return $uniqueDir;
    }

    public function clone(string $url, int $depth = 1): string
    {
        $options = ['depth' => (string)$depth];
        $uniqueDir = $this->makeUniqueDirectory();
        $this->gitWrapper->cloneRepository($url, $uniqueDir, $options);

        return $uniqueDir;
    }

    public function getCommitInfo(string $sourceDir): CommitInfo
    {
        $wc = $this->gitWrapper->workingCopy($sourceDir);
        $log = $wc->show('HEAD', ['s' => true, 'pretty=format:%H%n%an <%ae>%n%ci%n%s' => true]);
        $parts = explode("\n", $log);
        return new CommitInfo($parts[0], $parts[1], $parts[2], $parts[3]);
    }

    public function checkoutParent(string $sourceDir): void
    {
        $wc = $this->gitWrapper->workingCopy($sourceDir);
        $wc->checkout('HEAD~');
    }

    public function checkoutParentIterator(string $sourceDir, int $depth)
    {
        while (true) {

            try {

                yield true;

                $depth--;
                if ($depth <= 0) {
                    return;
                }

                $this->checkoutParent($sourceDir);


            } catch (GitException $e) {

                // No more git commit parents in source dir
                return;

            }

        }
    }

    public function cleanupSourceDir(string $sourceDir): void
    {
        (new Process(['rm', '-rf', $sourceDir]))->run();
    }
}
