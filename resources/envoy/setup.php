<?php

$time = time();
$gitRepository = "https://github.com/otusteamedu/Laravel";
$gitBranch = "DSimakov/master";
$sourceDirectory = "/home/admin/sites/sckatik2.fvds.ru";
$deploymentDirectory = $sourceDirectory."/deploy/{$time}";

function logSuccessMessage($message) {
    return "echo '\033[32m" .$message. "\033[0m';\n";
}
function logErrorMessage($message) {
    return "echo '\033[31m" .$message. "\033[0m';\n";
}
