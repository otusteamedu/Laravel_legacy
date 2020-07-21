@setup
    include(__DIR__ . '/resources/envoy/setup.php');
@endsetup

@servers(['web' => ['root@82.202.236.137']])

@import('resources/envoy/tasks.blade.php')

@story('release:deploy')
    project.init
    project.deploy
    artisan.down
    migrates.mig
    test.run
    project.update
    deploy.clear
    deploy.finishing
    artisan.up
@endstory

@error
    if (in_array($task, ['project.init', 'project.deploy', 'migrates.mig'])) {
        echo shell_exec('envoy run deploy.clear');
        echo shell_exec('envoy run artisan.up');
        exit;
    }
@enderror

@finished
    echo shell_exec('rm $(ls | grep -P "Envoy[^.]*.php") 2>/dev/null');
@endfinished
