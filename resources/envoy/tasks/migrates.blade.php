@task('migrates.mig')
    {{ logSuccessMessage("Running migrations...") }}
    cd {{ $deploymentDirectory }}
    php artisan migrate
    {{ logSuccessMessage("Done.") }}
@endtask
