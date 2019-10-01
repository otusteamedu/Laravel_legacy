docker-compose-up:
	cd laradock-p && docker-compose up -d mysql nginx

docker-compose-down:
	cd laradock-p && docker-compose down

docker-workspace:
	cd laradock-p && docker-compose exec workspace bash

docker-yarn-watch:
	cd laradock-p && docker-compose exec workspace yarn watch

docker-composer-update:
	cd laradock-p && docker-compose exec workspace composer update

yarn-dev:
	yarn development

artisan-ide-model:
	php artisan ide-helper:model -W
