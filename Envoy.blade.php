@servers(['web' => ['archvile@31.31.192.240']])

@setup
    $dir = '~/www/release'.\Carbon\Carbon::now()->format('YmdHis');
    $branch = $branch ?? 'master';
@endsetup

@story('deploy')
    git_clone
    composer_install
    link_shared
    cache_clear
    migrate
    cache_warm
    toggle_server
    server_status
@endstory

@task('ls')
    cd ~/www/
    ls -al
@endtask

@task('git_clone')
    cd ~/www/
    git clone https://github.com/otusteamedu/Laravel {{ $dir }} -b KKondratenko/{{ $branch }}
@endtask

@task('composer_install')
    cd {{ $dir }}
    /opt/php72/bin/php /usr/local/bin/composer install
@endtask

@task('link_shared')
    cd {{ $dir }}
    ln -snf ~/www/shared/public/upload/ {{ $dir }}/public/upload
    ln -snf ~/www/shared/.env {{ $dir }}/.env
@endtask

@task('cache_clear')
    cd {{ $dir }}
    /opt/php72/bin/php artisan config:clear
    /opt/php72/bin/php artisan cache:clear
    /opt/php72/bin/php artisan view:clear
@endtask

@task('migrate')
    cd {{ $dir }}
    /opt/php72/bin/php artisan migrate
@endtask

@task('cache_warm')
    cd {{ $dir }}
    /opt/php72/bin/php artisan config:cache
@endtask

@task('toggle_server')
    cd ~/www/
    ln -snf {{ $dir }} ~/www/otus.0x25.ru
@endtask

@task('server_status')
    cd ~/www/otus.0x25.ru
    /opt/php72/bin/php artisan -V
    git branch
@endtask