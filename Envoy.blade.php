@servers(['web'=>['localhost' => '127.0.0.1']])
@setup
  $branch='RMukhametzyanov/hw7';
  $env_dev=file_get_contents('./.env.deploy.dev');
  $env_prod=file_get_contents('./.env.deploy.prod');
@endsetup
@story('deploy.dev')
  git
  composer
  env.dev
  migrate
@endstory
@story('deploy.prod')
  git
  composer
  env.prod
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

@task('env.dev')
  cd Laravel
  echo "{{$env_dev}}" >> .env
  echo "\nReady.ENV\n"
  cd ../
@endtask
@task('env.prod')
  cd Laravel
  echo "{{$env_prod}}" >> .env
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
