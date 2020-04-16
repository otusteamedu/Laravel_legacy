<?php
/**
 * Description of sync-deployment-dir.blade.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Igor Abdrazakov <igor@mister.am>
 */
?>

@task('livesiteSyncDeploymentDir')
    {{ logSuccessMessage("Syncing deployment directory...") }}
    mkdir -p {{ $deploymentDirectory }}
    rsync -r --exclude 'resources/assets' --exclude 'vendor' {{ $sourceDirectory }}/ {{ $deploymentDirectory }}/
    @if (empty($composer) || $composer !== 'true')
        {{ logSuccessMessage("Linking deployment vendor directory...") }}
        ln -sf {{ $vendorSourcePath }}/vendor {{ $deploymentDirectory }}/vendor
    @endif
    ln -sf {{ $workingDirectory }}/.env {{ $deploymentDirectory }}/.env
    {{ logSuccessMessage("Done.") }}
@endtask

@task('livesiteRollbackDeploymentDir')
    {{ logSuccessMessage("Rolling back deployment directory...") }}
    rm -rf {{ $deploymentDirectory }}
    {{ logSuccessMessage("Done.") }}
@endtask
