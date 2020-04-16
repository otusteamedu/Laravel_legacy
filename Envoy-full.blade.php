@setup
    include(__DIR__ . '/resources/envoy/setup.php');
@endsetup

@servers([$server => $serverConfigs['host']])

@import('resources/envoy/livesite.blade.php')

@error
    if ($task == 'livesiteGit') {
        echo shell_exec('envoy run livesiteRollbackDeploymentDir');
        echo shell_exec('envoy run livesiteAppUp');
        exit;
    }
    if ($task == 'livesiteComposer') {
        echo shell_exec('envoy run livesiteRollbackComposer');
        echo shell_exec('envoy run livesiteRollbackDeploymentDir');
        echo shell_exec('envoy run livesiteAppUp');
        exit;
    }
    if ($task == 'livesiteMigrations') {
        echo shell_exec('envoy run livesiteRollbackComposer');
        echo shell_exec('envoy run livesiteRollbackDeploymentDir');
        echo shell_exec('envoy run livesiteAppUp');
        exit;
    }
@enderror

@finished
echo shell_exec('rm $(ls | grep -P "Envoy[^.]*.php") 2>/dev/null');
@endfinished
