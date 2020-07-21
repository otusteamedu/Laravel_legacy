@task('deploy.finishing')
    {{ logSuccessMessage("Clearing cache & finishing deploy...") }}
    cd {{ $sourceDirectory }}
    php artisan app:cache:clear --all
    php artisan queue:restart
    {{ logSuccessMessage("Build successful.") }}
@endtask

@task('deploy.clear')
    rm -Rf {{ $deploymentDirectory }}
    {{ logSuccessMessage("Deploy folder clear successful.") }}
@endtask
