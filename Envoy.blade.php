@servers(['web' => ['archvile@31.31.192.240']])

@story('deploy')
    rm
    git
    composer
    init
    migrate
@endstory

@task('rm')
    rm -rf /var/www/archvile/data/www/otus.0x25.ru
@endtask

@task('git')
    git clone https://github.com/otusteamedu/Laravel /var/www/archvile/data/www/otus.0x25.ru -b KKondratenko/hw17
@endtask

@task('composer')
    cd /var/www/archvile/data/www/otus.0x25.ru/
    /opt/php73/bin/php /usr/local/bin/composer install
@endtask

@task('init')
    cd /var/www/archvile/data/www/otus.0x25.ru/
    cp .env.example .env
@endtask

@task('migrate')
    cd /var/www/archvile/data/www/otus.0x25.ru/
    /opt/php73/bin/php artisan db:wipe
    /opt/php73/bin/php artisan migrate
@endtask