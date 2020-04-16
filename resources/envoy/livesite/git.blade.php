<?php
/**
 * Description of git.blade.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Igor Abdrazakov <igor@mister.am>
 */
?>

@task('livesiteGit')
    {{ logSuccessMessage("Fetching {$branch} from git repo...") }}
    cd {{ $deploymentDirectory }}
    git fetch --tags --progress {{ $repository }} +refs/heads/*:refs/remotes/origin/*
    git config core.sparseCheckout true
    COMMIT_HASH="$(git rev-parse origin/{{ $branch }}^{commit})"
    git checkout "${COMMIT_HASH}" -q
    git rev-list --no-walk "${COMMIT_HASH}"
    {{ logSuccessMessage("Done.") }}
@endtask
