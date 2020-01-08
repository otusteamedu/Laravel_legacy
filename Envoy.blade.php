@servers(['web' => ['sigma@188.120.243.205']])

@macro('deploy', ['on' => 'web'])
git
conf
composer
@endmacro

@task('git')
cd /var/www/sigma/data/www/_engines/laravel
git pull origin VYermakov/master
rm -R kinchik
mv master kinchik
@endtask

@task('conf')
cp ~/c/.env /var/www/sigma/data/www/_engines/laravel/kinchik
cp ~/c/database.php /var/www/sigma/data/www/_engines/laravel/kinchik/config/
@endtask

@task('composer')
cd /var/www/sigma/data/www/_engines/laravel/kinchik
composer update
@endtask
