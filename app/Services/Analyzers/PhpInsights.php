<?php


namespace App\Services\Analyzers;


use App\Contracts\Analyzer;
use Symfony\Component\Process\Process;

class PhpInsights implements Analyzer
{
    /**
     * @var string
     */
    private $phpInsightsBin;

    public function __construct(string $phpInsightsBin)
    {
        $this->phpInsightsBin = $phpInsightsBin;
    }

    public function run(string $path): array
    {
        $cmd = [
            $this->phpInsightsBin,
            'analyse',
            $path,
            '--format=json',
        ];

        $process = new Process($cmd);
        $process->mustRun();

        $json = $process->getOutput();
        return json_decode($json, true, 512, JSON_THROW_ON_ERROR);
    }
}
