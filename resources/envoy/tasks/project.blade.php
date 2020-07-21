@task('project.init')
    {{ logSuccessMessage("Project init start...") }}
    mkdir -p {{ $sourceDirectory }}
    if [ "$(ls -A {{ $sourceDirectory }})" ]; then
        {{ logSuccessMessage("Project was install.") }}
    else
        git clone  --single-branch --branch {{$gitBranch}} {{ $gitRepository }} {{ $sourceDirectory }}
        cd {{ $sourceDirectory }}
        cp ../common/.env .env
        composer install
        php artisan migrate:install
        {{ logSuccessMessage("Done.") }}
    fi
@endtask

@task('project.update')
    {{ logSuccessMessage("Project update start...") }}
    cd {{ $sourceDirectory }}
    git add --all
    git reset --hard
    git checkout {{ $gitBranch }}
    git pull origin {{ $gitBranch }}
    composer install
    {{ logSuccessMessage("Done.") }}
@endtask

@task('project.deploy')
    {{ logSuccessMessage("Project deploy start...") }}
    mkdir -p {{ $deploymentDirectory }}
    git clone  --single-branch --branch {{$gitBranch}} {{ $gitRepository }} {{ $deploymentDirectory }}
    cd {{ $deploymentDirectory }}
    cp ../../common/.env .env
    composer install
    {{ logSuccessMessage("Done.") }}
@endtask
