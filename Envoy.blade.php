
@servers(['web' => 'user@80.78.254.239'])

@setup
    $server = 'web';
    $serverConfigs = ['user@80.78.254.239'];

    $repository = 'https://github.com/otusteamedu/Laravel.git';
    $branch = 'VMeshavkin/hw17';
    $path = '/var/www/';
    $projectPath = '/var/www/'.date('Ymdhis') ;
    $dirName =  date('Ymdhis');

    $slackWebhookUrl = 'https://hooks.slack.com/services/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';
    $slackRoom = '#general';
@endsetup

@story('init', ['on' => 'web'])
    init
@endstory

@story('deploy', ['on' => 'web'])
    git:pull
    composer:install
    semLink:make
    config:cache
    queue:restart
    app:cache:warm
    app:phpunit
@endstory

@story('rollback', ['on' => 'web'])
    semLink:rollback
@endstory

@task('semLink:rollback')
    unlink {{$path}}current
    mv -T {{$path}}previous {{$path}}current
@endtask

@task('init')
    cd {{$path}}
    git clone --branch {{$branch}} {{$repository}} {{$dirName}}
    ln -s {{$projectPath}} {{$path}}previous
    ln -s {{$projectPath}} {{$path}}current
@endtask

@task('git:pull')
    cd {{$path}}
    git clone --branch {{$branch}} {{$repository}} {{$dirName}}
@endtask

@task('semLink:make')
    unlink {{$path}}previous
    mv -T {{$path}}current {{$path}}previous
    ln -s {{$projectPath}} {{$path}}current
@endtask

@task('app:migrate')
    cd {{$projectPath}}
    php artisan migrate
@endtask

@task('config:cache')
    cd {{$projectPath}}
    php artisan config:cache
@endtask

@task('queue:restart')
    cd {{$projectPath}}
    php artisan queue:restart
@endtask

@task('app:cache:warm')
    cd {{$projectPath}}
    php artisan cache:clear
    php artisan cache:warm
@endtask

@task('composer:install', ['on' => 'web'])
    cd {{$projectPath}}
    rm composer.lock
    composer install
@endtask

@task('app:phpunit', ['on' => 'web'])
    cd {{$projectPath}}
    php vendor/bin/phpunit
@endtask

@finished
    @slack($slackWebhookUrl, $slackRoom, 'deploy OK')
@endfinished
