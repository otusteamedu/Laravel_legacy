@servers(['web' => ['otus@139.162.156.72']])

@story('deploy')
  git
@endstory

@task('git', ['on' => 'web'])
  git clone --single-branch --branch YHerasymchuk/controllers https://github.com/otusteamedu/Laravel
@endtask

@task('composer')
  composer install
@endtask

@task('tests')
  php vendor/bin/phpunit --testdox
@endtask
