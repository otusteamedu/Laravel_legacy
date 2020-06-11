@servers(['web' => ['laradock@95.214.9.235']])

@task('foo', ['on' => 'web'])
    cd /home/laradock/htdocs/instagraphia.kz
    git pull origin master
    cd /home/laradock/laradock
    docker-compose exec -T -u laradock workspace bash -c "cd /var/www/instagraphia.kz && \
npm i && \
npm audit fix && \
composer install && \
php artisan migrate"
@endtask
