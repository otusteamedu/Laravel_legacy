@task('artisan.down')
    if [ -f "{{ $sourceDirectory }}/artisan" ]; then
        cd {{ $sourceDirectory }}
        php artisan down
        {{ logSuccessMessage("Artisan down success!") }}
    else
        {{ logErrorMessage("artisan not found!") }}
    fi
@endtask

@task('artisan.up')
    if [ -f "{{ $sourceDirectory }}/artisan" ]; then
        cd {{ $sourceDirectory }}
        php artisan up
        {{ logSuccessMessage("Artisan up success!") }}
    else
        {{ logErrorMessage("artisan not found!") }}
    fi
@endtask
