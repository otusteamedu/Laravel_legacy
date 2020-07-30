@servers(['local' => '127.0.0.1'])

@setup
    $deployDir = "../deploy/releases";
	$releaseDate = date('YmdHis');
    $releaseDir = $deployDir .'/'. $releaseDate;
    $repository = "https://github.com/otusteamedu/Laravel";
    $branch = "SDavidenko/master";

@endsetup

@story('deploy',  ['on' => 'local'])
    git:clone
    composer:install
    migrate
    cache:clear
    supervisor:restart
    tests:run
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

@task('migrate')
	echo "database migrate..."
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
