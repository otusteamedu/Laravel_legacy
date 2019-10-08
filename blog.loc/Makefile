test:
	@docker exec app_php-fpm_1 php -v
mysql:
	mysql -uhomestead -p --port 33061 --host 127.0.0.1

build-dev:
    docker exec blog_node_1 npm run dev