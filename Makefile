test:
	./vendor/bin/phpunit

dusk:
	php artisan dusk

test-cover:
	./vendor/bin/phpunit --coverage-html tests/coverage-report

ide:
	php artisan ide-helper:generate
	php artisan ide-helper:meta
	php artisan ide-helper:models -W

ide-model:
	php artisan ide-helper:models -W

deploy:
	vendor/bin/envoy run deploy
