@servers(['web'=>['localhost' => '127.0.0.1']])
@setup
  $branch='RMukhametzyanov/hw7';
  $env_exemp = file_get_contents('./.env.deploy');
  if ($env=='prod'){
      $app_env='prod';
      $app_debug='false';
  }
  if($env=='dev'){
      $app_env='local';
      $app_debug='true';
  }

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
  echo "{{$env_exemp}}" >> .env
  echo "APP_ENV={{$app_env}}" >> .env
  echo "APP_DEBUG={{$app_debug}}" >> .env
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
