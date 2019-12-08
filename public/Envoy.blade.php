@servers(['web' => ['root@78.108.95.175']])

@macro('deploy', ['on' => 'web'])
git
vars
composer
storage
@endmacro

@task('git')
cd /var/www
git clone https://github.com/chertokdmitry/ilogistics.git
rm -R timetable.devfolio.ru
mv ilogistics timetable.devfolio.ru
@endtask

@task('vars')
cp /var/www/vars/timetable/.env /var/www.timetable.devfolio.ru
cp /var/www/vars/timetable/database.php /var/www.timetable.devfolio.ru/config/
@endtask

@task('composer')
cd timetable.devfolio.ru
composer update
@endtask

@task('storage')
cd storage/
mkdir -p framework/{sessions,views,cache}
cd ..
chmod -R 777 storage
chown -R www-data:www-data storage
@endtask



