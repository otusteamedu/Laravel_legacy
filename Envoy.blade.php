

@servers(['web' => ['user@80.78.254.239']])

@story('init')
    git_init
    composer
@endstory

@story('deploy')
    git_clone
    composer
@endstory

@task('git_init', ['on' => 'web'])
    git clone --single-branch --branch VMeshavkin/hw16(rw) https://github.com/otusteamedu/Laravel.git
@endtask

@task('git_clone', ['on' => 'web'])
    cd Laravel
    git pull origin VMeshavkin/hw16(rw)
@endtask

@task('composer', ['on' => 'web'])
    cd Laravel
    composer install
@endtask


@task('test', ['on' => 'web'])
    php vendor/bin/phpunit
@endtask
