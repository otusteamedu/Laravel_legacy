@import('resources/envoy/livesite/app-maintenance-mode.blade.php')
@import('resources/envoy/livesite/prepare-source-dir.blade.php')
@import('resources/envoy/livesite/sync-deployment-dir.blade.php')
@import('resources/envoy/livesite/git.blade.php')
@import('resources/envoy/livesite/composer.blade.php')
@import('resources/envoy/livesite/migrations.blade.php')
@import('resources/envoy/livesite/update-sym-links.blade.php')
@import('resources/envoy/livesite/clean-old-version.blade.php')
@import('resources/envoy/livesite/finish-deploy.blade.php')

@story('livesite:release:deploy')
    livesiteAppDown
    livesitePrepareSourceDir
    livesiteSyncDeploymentDir
    livesiteGit
    livesiteComposer
    livesiteMigrations
    livesiteUpdateSymLinks
    livesiteCleanOldVersions
    livesiteAppFinishDeploy
@endstory

@story('livesite:release:rollback')
    livesiteAppUp
    livesiteRollbackDeploymentDir
    livesiteRollbackComposer
    livesiteRollbackMigrations
@endstory
