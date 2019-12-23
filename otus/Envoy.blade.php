@servers(['localhost' => '127.0.0.1'])

@story('deploy')
git
composer
tests
@endstory

@task('git')
cd /home/maxfolder/workspace/vhosts/envoy
git clone https://github.com/MaxFolder/Laravel.git
@endtask

@task('composer')
cd /home/maxfolder/workspace/vhosts/envoy
composer install
@endtask


