@servers(['web' => ['192.168.10.10']])


@setup

  $app_dir = '~/code/todo';
  $envoy_dir = '~/code/envoy';

@endsetup


@story('deploy')
  git
  cp_env
  composer
  migrate
  tests
@endstory


@task('git', ['on' => 'web'])
  cd ~/code
  rm todo -rf
  git clone https://github.com/Albinamkh21/todo.git
@endtask

@task('cp_env', ['on' => 'web'])
  cp {{$envoy_dir}}/.env  {{$app_dir}}/.env
@endtask


@task('composer')
  cd {{$app_dir}}
  composer install
@endtask


@task('list', ['on' => 'web'])
  cd {{$app_dir}}
  ls -la
@endtask

@task('migrate')
  cd {{$app_dir}}
  php artisan migrate:fresh --seed
@endtask

@task('tests')
  cd {{$app_dir}}
  php vendor/bin/phpunit
@endtask