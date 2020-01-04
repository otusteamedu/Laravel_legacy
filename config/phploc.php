<?php
return [

    // Array of directories to analyze, for example: ['app', 'database']
    // default: analyze all source code in current project
    'values' => ['.'],

    // Array of files extensions to analyze, for example ['*.php', '*.php3']
    // default: analyze only *.php files
    'names' => ['*.php'],

    // Array of files to exclude from analysis, for example ['config/config.php', '1.php']
    // default: nothing to exclude
    'names-exclude' => ['_ide_helper.php'],

    // Array of directories to exclude from analysis, for example ['vendor', 'bootstrap', 'storage', 'resources']
    // default: ['vendor', 'bootstrap', 'storage']
    'exclude' => ['vendor', 'bootstrap', 'storage'],

    // Count PHPUnit test case classes and test methods
    'count-tests' => false,

    // CSV filename to write analysis result, for example 'results/phploc.csv'
    // default: do not write to file
    'log-csv' => null,
];
