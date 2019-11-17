@servers(['web'=>['localhost' => '127.0.0.1']])
@setup
  $branch='RMukhametzyanov/hw7';
  $env=file_get_contents('./.env.deploy');
@endsetup
@story('deploy')
  git
  composer
  env
  migrate
@endstory
@task('git', ['on' => 'web'])
  git clone -b {{$branch}} --single-branch https://github.com/otusteamedu/Laravel.git
  echo "\nReady. Clone\n"
@endtask
@task('composer', ['on' => 'web'])
    cd Laravel
    composer install
    echo "\nReady. Composer\n"
    cd ../
@endtask

@task('env')
  cd Laravel
  echo "{{$env}}" >> .env
  echo "\nReady.ENV\n"
  cd ../
@endtask

@task('migrate', ['on' => 'web'])
    cd Laravel
    php artisan key:generate
    php artisan migrate
    php artisan db:seed
    echo "\nReady. Migrate\n"
    cd ../
@endtask
