<?php
/**
 * Description of setup.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Igor Abdrazakov <igor@mister.am>
 */

require 'init.php';

if (!isset($server)) {
    throw new Exception("server option is required");
}
$serverConfigs = getServerConfigsByServerName($server);
if (!$serverConfigs) {
    throw new Exception("Server {$server} is not defined. Please, check you stagings.json file");
}

$time = time();
$repository = config("services.{$serverConfigs['project-type']}.git-repository");
$branch = $branch ?? 'master';

$sourceDirectory = $serverConfigs['source-directory-path'];
$deploymentPath = $serverConfigs['deployment-path'];
$deploymentDirectory = "{$deploymentPath}/{$time}";
$workingDirectory = $serverConfigs['working-directory-path'];
$vendorSourcePath = $serverConfigs['vendor-source-path'];

function logSuccessMessage($message) {
    return "echo '\033[32m" .$message. "\033[0m';\n";
}

function getServerConfigsByServerName($serverName) {
    return config("stagings.{$serverName}") ?? [];
}
