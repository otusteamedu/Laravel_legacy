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

@task('app:docker')
    docker network create br-docker -o com.docker.network.bridge.name="br-docker" --subnet=192.168.94.0/24 --ip-range=192.168.94.128/25
    docker build --no-cache -t akuznetsov/fpm:v1 /opt/docker/fpm_npm_composer/
    docker run -v /var/www/html:/var/www/html -d --network br-docker --name dphp --hostname dphp akuznetsov/fpm:v1
    docker run -p 80:80 -v /etc/nginx/site_enabled:/etc/nginx/conf.d -v /var/www/html:/var/www/html -d --network br-docker --name dnginx --hostname dnginx nginx
    docker run -v /var/lib/postgresql/data/:/var/lib/postgresql/data/ -d -p 127.0.0.1:5432:5432 --network br-docker --name dpg --hostname dpg postgres
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
