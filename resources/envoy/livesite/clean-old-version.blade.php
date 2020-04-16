<?php
/**
 * Description of clean-old-version.blade.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Igor Abdrazakov <igor@mister.am>
 */
?>

@task('livesiteCleanOldVersions')
    {{ logSuccessMessage("Cleaning old version...") }}
    cd {{ $deploymentPath }}
    find . -maxdepth 1 ! -name '{{ $time }}' -type d -exec rm -rf {} + 2>/dev/null
    rm -rf {{ $vendorSourcePath }}/vendor_bac
    {{ logSuccessMessage("Done.") }}
@endtask