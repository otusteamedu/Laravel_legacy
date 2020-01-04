<?php


namespace App\Services\Analyzers;


use App\Contracts\Analyzer;
use App\Exceptions\AnalyzerException;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Exception\RuntimeException;
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

        try {

            $process = new Process($cmd);
            $process->setTimeout(500);
            $process->mustRun();

            $json = $process->getOutput();

        } catch (ProcessFailedException $e) {

            $msg = $e->getMessage();
            $outputMsg = substr($msg, strpos($msg, 'Output:'), -1 * (strlen($msg) - strpos($msg, 'Error Output:')));
            throw new AnalyzerException('Can\'t run PHP Insights: ' . trim($outputMsg), 0, $e);

        } catch (RuntimeException $e) {

            report($e);
            throw new AnalyzerException('Can\'t run PHP Insights: ' . $e->getMessage(), 0, $e);

        }

        $data = json_decode($json, true, 512, JSON_THROW_ON_ERROR);

        // Rename "security issues" to "security_issues"
        $data['summary']['security_issues'] = $data['summary']['security issues'];
        unset($data['summary']['security issues']);

        return $data;
    }
}
