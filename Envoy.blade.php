@servers(['localhost' => '127.0.0.1'])

@story('deploy')
git
composer
migrate
cache
@endstory

@task('git')
cd /___domains/laravel2.loc
git clone https://github.com/RomIII/laravel2.loc.git
@endtask

@task('composer')
cd /___domains/laravel2.loc
composer install
@endtask

@task('migrate')
cd /___domains/laravel2.loc
php artisan migrate
@endtask

@task('cache')
cd /___domains/laravel2.loc
php artisan cache:clear
php artisan route:clear
php artisan config:clear
php artisan view:clear
@endtask