@servers(['web' => ['vagrant@192.168.10.70']])

@task('composer', ['on' => 'web'])
    cd /home/vagrant/laravel-deploy/
    composer install
@endtask

@task('prepare-path', ['on' => 'web'])
    rm -rf /home/vagrant/laravel-deploy/*
    rm -rf /home/vagrant/laravel-deploy/.[^.]*
@endtask

@task('git-clone', ['on' => 'web'])
    cd /home/vagrant/laravel-deploy/
    git clone --single-branch --branch origin/master https://github.com/PanovAlexey/icarhelper.git .

    mv /home/vagrant/laravel-deploy/.env.example /home/vagrant/laravel-deploy/.env

    @if ($DB_DATABASE && $DB_USERNAME && $DB_PASSWORD)
        cat >> /home/vagrant/laravel-deploy/.env <<EOF
            DB_DATABASE={{ $DB_DATABASE }}
            DB_USERNAME={{ $DB_USERNAME }}
            DB_PASSWORD={{ $DB_PASSWORD }}
        EOF
    @endif
@endtask

@task('git_update', ['on' => 'web'])
    cd /home/vagrant/laravel-deploy/
    git fetch origin/master
    git reset --hard
    git checkout origin/master
@endtask

@task('migrate', ['on' => 'web'])
    cd /home/vagrant/laravel-deploy/
    php artisan migrate --force
@endtask

@task('tests', ['on' => 'web'])
    cd /home/vagrant/laravel-deploy/
    ./vendor/phpunit/php
@endtask

@task('queue', ['on' => 'web'])
    cd /home/vagrant/laravel-deploy/
    php artisan queue:restart
@endtask

@task('cache', ['on' => 'web'])
    cd /home/vagrant/laravel-deploy/
    yes | php artisan cache:warm-up -D
@endtask

@task('build_frontend', ['on' => 'web'])
    cd /home/vagrant/laravel-deploy/
    npm install
    npm run dev
@endtask

@story('deploy-full')
    prepare-path
    git-clone
    composer
    migrate
    queue
    cache
    build_frontend
@endstory

@story('deploy-update')
    git_update
    composer
    migrate
    queue
    cache
    build_frontend
@endstory
