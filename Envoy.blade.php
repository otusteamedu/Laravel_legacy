@servers(['production' => ['laradock@95.214.9.235']])

@task('git', ['on' => 'production'])
    cd /home/laradock/htdocs/instagraphia.kz
    git checkout -b master
    git pull origin master
@endtask

@task('npm', ['on' => 'production'])
    cd /home/laradock/laradock
    docker-compose exec -w /var/www/instagraphia.kz -T -u laradock workspace bash -c "\
    npm i && \
    npm audit fix"
@endtask

@task('composer', ['on' => 'production'])
    cd /home/laradock/laradock
    docker-compose exec -w /var/www/instagraphia.kz -T -u laradock workspace bash -c "\
    composer install"
@endtask

@task('migrate', ['on' => 'production'])
    cd /home/laradock/laradock
    docker-compose exec -w /var/www/instagraphia.kz -T -u laradock workspace bash -c "\
    php artisan migrate"
@endtask

@story('deploy:production')
    git
    npm
    composer
    migrate
@endstory
