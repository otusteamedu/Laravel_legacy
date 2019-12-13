<?php


namespace App\Services;


use GitWrapper\GitWrapper;

class GitOperations
{
    private const GIT_STORAGE = 'git';

    /** @var GitWrapper */
    private $gitWrapper;

    public function __construct(string $gitBinary)
    {
        $this->gitWrapper = new GitWrapper($gitBinary);
    }

    private function makeUniqueDirectory()
    {
        do {
            $uniqueDir = self::GIT_STORAGE . '/' . time() . '_' . random_int(0, PHP_INT_MAX);
        } while (\Storage::exists($uniqueDir));

        \Storage::makeDirectory($uniqueDir);

        return $uniqueDir;
    }

    public function clone(string $repository, int $depth = 1): string
    {
        $options = ['depth' => (string)$depth];
        $uniqueDir = $this->makeUniqueDirectory();
        $uniqueDirAbsolutePath = \Storage::path($uniqueDir);
        $this->gitWrapper->cloneRepository($repository, $uniqueDirAbsolutePath, $options);

        return $uniqueDir;
    }
}
