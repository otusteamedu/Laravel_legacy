@servers(['local' => '127.0.0.1'])

@setup
    $appDir = "../app";
    $deployDir = "../app/releases";
	$releaseDate = date('YmdHis');
    $releaseDir = $deployDir .'/'. $releaseDate;
    $repository = "https://github.com/otusteamedu/Laravel";
    $branch = "SDavidenko/master";
@endsetup

@story('deploy',  ['on' => 'local'])
    git:clone
    composer:install
    symlinks
    migrate
    cache:clear
    supervisor:restart
    tests:run
    deploy:end
@endstory

@task('git:clone')
	echo "git clone..."
	[ -d {{ $releaseDir }} ] || mkdir {{ $releaseDir }}
    git clone --branch {{$branch}} {{$repository}} {{$releaseDir}}
@endtask

@task('composer:install')
	echo "composer installing..."
    cd {{$releaseDir}}
    composer install
@endtask

@task('symlinks')
    echo "Linking..."
    rm -rf {{$releaseDir}}/storage
    echo 'Linking storage...'
    ln -nsf {{$appDir}}/storage {{$releaseDir}}/storage
    echo 'Linking .env file...'
    ln -nsf {{$appDir}}/.env {{$releaseDir}}/.env
@endtask

@task('migrate')
	echo "Database migrate..."
    cd {{$releaseDir}}
    php artisan migrate
@endtask

@task('cache:clear')
	echo "clearing cache data..."
    cd {{$releaseDir}}
    php artisan config:clear
    php artisan cache:clear
@endtask

@task('supervisor:restart')
	echo "restarting supervisor..."
    supervisorctl restart all
@endtask

@task('tests:run')
	echo "testing..."
    cd {{$releaseDir}}
    php vendor/bin/phpunit
@endtask

@task('deploy:end')
    echo "End deploy..."
    echo 'Linking current release...'
    ln -nsf {{$releaseDir}} {{$appDir}}/current
    cd {{$deployDir}}
    echo "Removing old releases..."
    rm -r `ls -1t $d | head -n-5`
    echo "SUCCESS!"
@endtask
