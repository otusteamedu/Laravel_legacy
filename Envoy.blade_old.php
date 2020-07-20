

@servers(['web' => ['user@80.78.254.239']])

@story('deploy')
    git:clone
    install:composer
    run:migrations
@endstory

@task('git:clone', ['on' => 'web'])
    cd Laravel
    git clone --single-branch --branch VMeshavkin/hw17 https://github.com/otusteamedu/Laravel.git
@endtask

@task('install:composer', ['on' => 'web'])
    cd Laravel
    composer install
@endtask

@task('run:migrations', ['confirm' => true])
    php artisan migrate
@endtask

@task('test', ['on' => 'web'])
    php vendor/bin/phpunit
@endtask
