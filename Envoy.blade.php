@setup
    $user = 'root';
    $timezone = 'Europe/Moscow';
    $path = '/var/web/scheduller';
    $currentDir = $path . '/current';
    $repository = 'git@github.com:otusteamedu/Laravel.git';
    $branch = 'DShitikov/master';
    $chmods = [
        'storage/logs'
    ];
    $date = new DateTime('now', new DateTimeZone($timezone));
    $releaseDir = $path . '/releases/' . $date->format('YmdHis');
@endsetup

@servers(['production' => [$user . '@194.67.78.89']])

@story('deploy',  ['on' => 'production'])
    git:clone
    composer:install
    env:prepare
    npm:install
    npm:build
    migrate:run
    optimize
    permissions
    cache:warm
    tests:run
    symlink
    supervisor:restart
@endstory

@task('git:clone')
    cd /
    mkdir -p {{$releaseDir}}
    git clone --depth 1  -b {{$branch}} {{$repository}} {{$releaseDir}}
    echo "Repository was cloned."
@endtask

@task('env:prepare')
    cd {{ $releaseDir }}
    ln -nfs {{ $path }}/.env .env
    chgrp -h www-data .env

    php artisan config:clear
    echo "Env is ready."
@endtask

@task('composer:install')
    cd {{ $releaseDir }}
    composer install --prefer-dist
    echo "Composer dependencies was installed."
@endtask

@task('npm:install')
    cd {{ $releaseDir }}
    npm install
    echo "Npm dependencies was installed."
@endtask

@task('npm:build')
    cd {{ $releaseDir }}
    npm run prod
    echo "Npm was built."
@endtask

@task('migrate:run')
    echo "Run migrations..."
    cd {{ $releaseDir }}
    php artisan migrate --force
    echo "Migrations run success."
@endtask

@task('supervisor:restart')
    supervisorctl restart all
    echo "Supervisor restart"
@endtask

@task('optimize')
    cd {{ $releaseDir }}
    php artisan clear-compiled --env=production;
    php artisan optimize --env=production; нужно убрать замыкание в env
@endtask

@task('permissions')
    chgrp -R www-data {{ $releaseDir }}
    chmod -R ug+rwx {{ $releaseDir }}

    @foreach($chmods as $file)
        chmod -R 775 {{ $releaseDir }}/{{ $file }}
        chown -R {{ $user }}:www-data {{ $releaseDir }}/{{ $file }}
        echo "Permissions was set for {{ $file }}."
    @endforeach
@endtask

@task('cache:warm')
    cd {{ $releaseDir }}
    php artisan cache:warm
    echo "Cache was warmed"
@endtask

@task('tests:run')
    cd {{$releaseDir}}
    php ./vendor/bin/phpunit
    echo "Success testing."
@endtask

@task('symlink')
    ln -nfs {{ $releaseDir }} {{ $currentDir }}
    chgrp -h www-data {{ $currentDir }}
    echo "Project linking."
@endtask
