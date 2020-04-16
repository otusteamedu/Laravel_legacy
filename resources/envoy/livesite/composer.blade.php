<?php
/**
 * Description of composer.blade.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Igor Abdrazakov <igor@mister.am>
 */
?>

@task('livesiteComposer')
    @if (!empty($composer) && $composer === 'true')
        if [ -d {{ $deploymentDirectory }} ]; then
            cd {{ $deploymentDirectory }}

            {{ logSuccessMessage("Backing up composer...: cp -Tf VENDOR_SOURCE_PATH/vendor VENDOR_SOURCE_PATH/vendor_bac") }}
            cp -Trf {{ $vendorSourcePath }}/vendor {{ $vendorSourcePath }}/vendor_bac

            {{ logSuccessMessage("Installing composer...: composer install --no-dev...") }}
            composer install --no-dev

            {{ logSuccessMessage("Syncing composer...:  rsync -r DEPLOYMENT_DIR/vendor VENDOR_SOURCE_PATH/") }}
            rsync -r {{ $deploymentDirectory }}/vendor {{ $vendorSourcePath }}/
            {{ logSuccessMessage("Done.") }}
        else
            {{ logSuccessMessage("No deployment dir.") }}
        fi
    @else
        {{ logSuccessMessage("Skipping composer.") }}
    @endif
    cd {{ $deploymentDirectory }}
    composer dump-autoload
@endtask

@task('livesiteRollbackComposer')
    if [ -d {{ $vendorSourcePath }}/vendor_bac]; then
        {{ logSuccessMessage("Rolling back composer...") }}
        rm -rf {{ $vendorSourcePath }}/vendor
        mv {{ $vendorSourcePath }}/vendor_bac {{ $vendorSourcePath }}/vendor
        {{ logSuccessMessage("Done.") }}
    fi
@endtask