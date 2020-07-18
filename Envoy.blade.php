@servers(['web' => 'root@77.222.52.73'])

@setup
    $repository = 'https://github.com/otusteamedu/Laravel';
    $branch = $branch ?? 'AKuznetsov/Master';
    $dir = '/var/www/html/badum/';
@endsetup

@task('clone_repository')
    echo "clone_repository"
    cd $site || exit 1
    git clone {{ $repository }} {{ $branch }}
@endtask

@task('run_migrations')
    echo "run_migrations"
    php artisan migrate
@endtask

@task('clear_cache')
    echo "clear_cache"
    cd $site
    php artisan cache:clear
    php artisan route:clear
    php artisan config:clear
    php artisan view:clear
@endtask

@task('link_shared')
    echo "link_shared"
    cd {{ $dir }}
    ln -snf ~/www/shared/public/upload/ {{ $dir }}/public/upload
    ln -snf ~/www/shared/.env {{ $dir }}/.env
@endtask

@task('run_tests')
    php vendor/bin/phpunit --testdox
@endtask

@story('deploy', ['on' => 'web'])
    echo "start deploy"
    clone_repository
    link_shared
    clear_cache
    run_migrations
    run_tests
    echo "finish deploy"
@endstory
