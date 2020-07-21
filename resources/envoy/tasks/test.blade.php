@task('test.run')
    cd {{ $deploymentDirectory }}
    php vendor/bin/phpunit
@endtask
