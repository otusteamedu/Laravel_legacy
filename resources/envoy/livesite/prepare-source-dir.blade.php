<?php
/**
 * Description of prepare-source-dir.blade.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Igor Abdrazakov <igor@mister.am>
 */
?>

@task('livesitePrepareSourceDir')
    {{ logSuccessMessage("Preparing source directory...") }}
    mkdir -p {{ $sourceDirectory }}
    cd {{ $sourceDirectory }}
    if [ "$(ls -A {{ $sourceDirectory }})" ]; then
        git checkout master
        git pull origin master
    else
        git clone "{{ $repository }}" {{ $sourceDirectory }}
        composer install
        @if ($vendorSourcePath != $sourceDirectory)
            mv {{ $sourceDirectory }}/vendor {{ $vendorSourcePath }}
        @endif
    fi
    {{ logSuccessMessage("Done.") }}
@endtask
