<?php
/**
 * Description of finish-deploy.blade.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Igor Abdrazakov <igor@mister.am>
 */
?>

@task('livesiteAppFinishDeploy')
    {{ logSuccessMessage("Clearing cache & finishing deploy...") }}
    cd {{ $workingDirectory }}
    @if(!empty($assets) && $assets === 'true')
        php artisan app:assets:up --level=all
    @endif
    @if(!empty($cache) && $cache === 'true')
        php artisan app:cache:clear --all
    @endif
    php artisan queue:restart
    php artisan up
    {{ logSuccessMessage("Build successful.") }}
@endtask