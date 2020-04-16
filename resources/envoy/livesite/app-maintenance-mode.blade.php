<?php
/**
 * Description of app-maintenance-mode.blade.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Igor Abdrazakov <igor@mister.am>
 */
?>

@task('livesiteAppDown')
    if [ -f "{{ $workingDirectory }}/artisan" ]; then
        cd {{ $workingDirectory }}
        php artisan down
    fi
@endtask

@task('livesiteAppUp')
    cd {{ $workingDirectory }}
    php artisan up
@endtask