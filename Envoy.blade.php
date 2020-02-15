@servers(['web' => ['archvile@31.31.192.240']])

@setup
    $server = $server ?? 's2';
    $branch = $branch ?? 'master'
@endsetup

@story('deploy')
    toggle_server
    cache
    fetch
    checkout
    composer
    migrate
    warm
@endstory

@task('ls')
    cd ~/www/
    ls -al
@endtask

@task('toggle_server')
    ln -snf ~/www/{{$server}}.otus.0x25.ru ~/www/otus.0x25.ru
@endtask

@task('cache')
    cd ~/www/otus.0x25.ru
    /opt/php72/bin/php artisan view:clear
    /opt/php72/bin/php artisan cache:clear
    /opt/php72/bin/php artisan config:clear
    /opt/php72/bin/php artisan event:clear
    /opt/php72/bin/php artisan queue:flush
    /opt/php72/bin/php artisan route:clear
@endtask

@task('fetch')
    cd ~/www/otus.0x25.ru
    git fetch https://github.com/otusteamedu/Laravel
@endtask

@task('checkout')
    cd ~/www/otus.0x25.ru
    git reset --hard
    git checkout KKondratenko/{{ $branch }}
@endtask

@task('composer')
    cd ~/www/otus.0x25.ru
    /opt/php72/bin/php /usr/local/bin/composer update --no-scripts
    /opt/php72/bin/php /usr/local/bin/composer dump-autoload
@endtask

@task('migrate')
    cd ~/www/otus.0x25.ru
    /opt/php72/bin/php artisan migrate
@endtask

@task('warm')
    cd ~/www/otus.0x25.ru
    /opt/php72/bin/php artisan config:cache
    /opt/php72/bin/php artisan event:cache
    /opt/php72/bin/php artisan view:cache
    {{--/opt/php72/bin/php artisan route:cache--}}
@endtask