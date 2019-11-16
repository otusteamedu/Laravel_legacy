@servers(['web'=>['localhost' => '127.0.0.1']])
@setup
  $branch='RMukhametzyanov/hw7';
  $env = file_get_contents('.env');
  $DB_HOST='127.0.0.1';
  $DB_PORT='3306';
  $DB_DATABASE='arabic1';
  $DB_USERNAME='root';
  $DB_PASSWORD='123';

@endsetup

@story('deploy')
  git
  composer
  env
  migrate
  ready
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
  echo "DB_HOST = {{$DB_HOST}}" >> .env
  echo "DB_PORT = {{$DB_PORT}}" >> .env
  echo "DB_DATABASE = {{$DB_DATABASE}}" >> .env
  echo "DB_USERNAME= {{$DB_USERNAME}}" >> .env
  echo "DB_PASSWORD = {{$DB_PASSWORD}}" >> .env
  echo "APP_NAME=Laravel" >> .env
  echo "APP_ENV=local" >> .env
  echo "APP_KEY=base64:1la63sDAVPuhdwM1gImLlZOuuyiy+qx9F5yXwYqQrkQ=" >> .env
  echo "APP_DEBUG=true" >> .env
  echo "APP_URL=http://127.0.0.1" >> .env
  echo "LOG_CHANNEL=stack" >> .env
  echo "DB_CONNECTION=mysql" >> .env
  echo "BROADCAST_DRIVER=log" >> .env
  echo "CACHE_DRIVER=file" >> .env
  echo "QUEUE_CONNECTION=sync" >> .env
  echo "SESSION_DRIVER=file" >> .env
  echo "SESSION_LIFETIME=120" >> .env

  echo "REDIS_HOST=127.0.0.1" >> .env
  echo "REDIS_PASSWORD=null" >> .env
  echo "REDIS_PORT=6379" >> .env

  echo "MAIL_DRIVER=smtp" >> .env
  echo "MAIL_HOST=smtp.mailtrap.io" >> .env
  echo "MAIL_PORT=2525" >> .env
  echo "MAIL_USERNAME=null" >> .env
  echo "MAIL_PASSWORD=null" >> .env
  echo "MAIL_ENCRYPTION=null" >> .env

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

@task('ready', ['on' => 'web'])
    echo "\nReady\n"
@endtask
