<?php
/**
 * Description of update-sym-links.blade.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Igor Abdrazakov <igor@mister.am>
 */
?>

@task('livesiteUpdateSymLinks')
    {{ logSuccessMessage("Updating symbol links...") }}
    mkdir -p {{ $workingDirectory }}
    mkdir -p {{ $workingDirectory }}/public
    mkdir -p {{ $workingDirectory }}/public/uploads
    cp -rfsT {{ $deploymentDirectory }}/storage {{ $workingDirectory }}/storage
    ln -sf $(ls -d {{ $deploymentDirectory }}/public/* | grep -v 'uploads') {{ $workingDirectory }}/public
    ln -sf $(ls -d {{ $deploymentDirectory }}/* | grep -v 'public' | grep -v 'storage') {{ $workingDirectory }}
    {{ logSuccessMessage("Done.") }}
@endtask