<?php


namespace App\Services\Analyzers;


use App\Contracts\Analyzer;
use App\Exceptions\AnalyzerException;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;

class PhpLoc implements Analyzer
{
    /**
     * @var string
     */
    private $phpLocBin;

    public function __construct(string $phpLocBin)
    {
        $this->phpLocBin = $phpLocBin;
    }

    public function run(string $sourceDir): array
    {
        $tmpfile = tempnam(sys_get_temp_dir(), 'phploc');
        $cmd = [
            $this->phpLocBin,
            '--exclude=vendor',
            '--log-json=' . $tmpfile,
            $sourceDir,
        ];

        try {

            $process = new Process($cmd);
            $process->setTimeout(500);
            $process->mustRun();

        } catch (RuntimeException $e) {

            report($e);
            throw new AnalyzerException('Can\'t run PHPLOC: ' . $e->getMessage(), 0, $e);

        }

        $json = file_get_contents($tmpfile);
        unlink($tmpfile);

        $data = json_decode($json, true, 512, JSON_THROW_ON_ERROR);

        $normalizedData = [];
        foreach ($data as $key => $val) {
            $snakeKey = Str::snake($key);
            $normalizedData[$snakeKey] = $val;
        }

        return $normalizedData;
    }
}
