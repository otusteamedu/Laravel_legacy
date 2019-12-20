<?php

namespace App\Console;

use Illuminate\Console\Command;
use SebastianBergmann\FinderFacade\FinderFacade;
use SebastianBergmann\PHPLOC\Analyser;
use SebastianBergmann\PHPLOC\Log\Csv;
use SebastianBergmann\PHPLOC\Log\Json;
use SebastianBergmann\PHPLOC\Log\Text;
use SebastianBergmann\PHPLOC\Log\Xml;

class PhpLocCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'phploc:run';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs a PHPLOC on your source code!';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'phploc:run {values?* : Path to source code, defult: current project}
            {--names=* : A comma-separated list of file names to check}
            {--names-exclude=* : A comma-separated list of file names to exclude}
            {--count-tests : Count PHPUnit test case classes and test methods}
            {--exclude=* : Exclude a directory from code analysis (multiple values allowed)}
            {--log-csv= : Write result in CSV format to file}
            {--log-json= : Write result in JSON format to file}
            {--log-xml= : Write result in XML format to file}
    ';

    public function handle()
    {
        $input = $this->input;

        $values = $input->getArgument('values') ?: config('phploc.values');

        $exclude = $input->getOption('exclude') ?: config('phploc.exclude');

        $names = $input->getOption('names') ?: config('phploc.names');
        $names = $this->explodeComaSeparatedOption($names);

        $namesExclude = $input->getOption('names-exclude') ?: config('phploc.names-exclude');
        $namesExclude = $this->explodeComaSeparatedOption($namesExclude);

        $countTests = $input->getOption('count-tests') ?: config('phploc.count-tests');

        $count = $this->count(
            $values,
            $exclude,
            $names,
            $namesExclude,
            $countTests
        );

        if (!$count) {
            $this->output->writeln('No files found to scan');
            exit(0);
        }

        $printer = new Text;

        $printer->printResult(
            $this->output,
            $count,
            $countTests
        );

        $logCsv = $input->getOption('log-csv') ?: config('log-csv');
        if ($logCsv) {
            $printer = new Csv;
            $printer->printResult($logCsv, $count);
        }

        $logJson = $input->getOption('log-json') ?: config('log-json');
        if ($logJson) {
            $printer = new Json;
            $printer->printResult($logJson, $count);
        }

        $logXml = $input->getOption('log-json') ?: config('log-xml');
        if ($logXml) {
            $printer = new Xml;
            $printer->printResult($logXml, $count);
        }
    }

    private function count(array $arguments, $excludes, $names, $namesExclude, $countTests)
    {
        try {
            $finder = new FinderFacade($arguments, $excludes, $names, $namesExclude);
            $files = $finder->findFiles();
        } catch (\InvalidArgumentException $ex) {
            return false;
        }

        if (empty($files)) {
            return false;
        }

        $analyser = new Analyser;

        return $analyser->countFiles($files, $countTests);
    }

    /**
     * Sometimes options are passed as coma separated values, for example: --names-exclude=a.php,b.php
     * Since options "names-exclude" and "names" are Array-like options, we get values as array:
     * [0 => 'a.php,b.php']
     * Now we need to split coma separated values to get full list of individual values
     * and return: [0 => 'a.php', 1 => 'b.php']
     * @param array $values
     * @return array
     */
    private function explodeComaSeparatedOption($values)
    {
        if (!\is_array($values)) {
            $values = [$values];
        }
        $out = [];
        foreach ($values as $stringValue) {
            $out = array_merge($out, \explode(',', $stringValue));
        }
        return $out;
    }
}
