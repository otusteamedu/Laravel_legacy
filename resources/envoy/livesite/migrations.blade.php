<?php
/**
 * Description of migrations.blade.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Igor Abdrazakov <igor@mister.am>
 */
?>

@task('livesiteMigrations')
    @if(!empty($migrations) && $migrations === 'true')
        {{ logSuccessMessage("Running migrations...") }}
        cd {{ $deploymentDirectory }}
        php artisan migrate
        {{ logSuccessMessage("Done.") }}
    @else
        {{ logSuccessMessage("No migrations.") }}
    @endif
@endtask

@task('livesiteRollbackMigrations')
    @if(!empty($migrations) && $migrations === 'true')
        {{ logSuccessMessage("Rolling back migrations...") }}
        php artisan migrate:rollback
        {{ logSuccessMessage("Done.") }}
    @else
        {{ logSuccessMessage("No migrations.") }}
    @endif
@endtask