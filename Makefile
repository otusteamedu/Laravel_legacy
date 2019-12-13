test:
	./vendor/bin/phpunit

test-cover:
	./vendor/bin/phpunit --coverage-html tests/coverage-report
