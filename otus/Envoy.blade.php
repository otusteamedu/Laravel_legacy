@servers(['localhost' => '127.0.0.1'])

@story('deploy')
git
composer
migrate
cache
@endstory

@task('git')
cd /home/maxfolder/workspace/vhosts/envoy
git clone https://github.com/MaxFolder/Laravel.git
@endtask

@task('composer')
cd /home/maxfolder/workspace/vhosts/envoy
composer install
@endtask

@task('migrate')
cd /home/maxfolder/workspace/vhosts/envoy
php artisan migrate
@endtask

@task('cache')
cd /home/maxfolder/workspace/vhosts/envoy
php artisan cache:clear
php artisan route:clear
php artisan config:clear
php artisan view:clear
@endtask


