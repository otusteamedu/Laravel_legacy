<?php

namespace App\Contracts;

interface Analyzer {

    /**
     * @param string $path Absolute path to code directory to analyze
     * @return array
     */
    public function run(string $path): array;
}
