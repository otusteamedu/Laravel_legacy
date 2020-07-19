@servers(['web' => 'root@77.222.52.73'])

@setup
    $repository = 'https://github.com/otusteamedu/Laravel';
    $branch = $branch ?? 'AKuznetsov/Master';
    $projectPath = '/var/www/html/badum/';
    $uploadPathLinkFrom . 'storage/app/public'
    $uploadPathLinkTo . 'public/storage'
@endsetup

@task('git:clone')
    echo "git:clone"
    cd {{ $projectPath }} || exit 1
    git clone {{ $repository }} {{ $branch }}
@endtask

@task('app:migrate')
    echo "app:migrate"
    php artisan migrate
@endtask

@task('app:cache:clear')
    echo "app:cache:clear"
    cd {{ $projectPath }}
    php artisan cache:clear
    php artisan route:clear
    php artisan config:clear
    php artisan view:clear
@endtask

@task('app:share_files')
    echo "app:share_files"
    ln -snf $uploadPathLinkFrom $uploadPathLinkTo
@endtask

@task('app:phpunit')
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
