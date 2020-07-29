<?php

$time = time();
$gitRepository = "https://github.com/otusteamedu/Laravel";
$gitBranch = "AKudryashov/master";
$sourceDirectory = "otus";
$deploymentDirectory = "deploy/{$time}";

function logSuccessMessage($message) {
    return "echo '\033[32m" .$message. "\033[0m';\n";
}
function logErrorMessage($message) {
    return "echo '\033[31m" .$message. "\033[0m';\n";
}
