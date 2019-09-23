docker-compose-up:
	cd laradock-p && docker-compose up -d mysql nginx

docker-compose-down:
	cd laradock-p && docker-compose down

yarn-dev:
	yarn development
