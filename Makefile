lint:
	npm run lint
	./vendor/bin/pint

pint:
	./vendor/bin/pint

install:
	composer install
	npm install

format:
	npm run format

test-ui:
	npm run test

test-api:
	php artisan test

test:
	npm run test
	php artisan test

build:
	npm run format

db:
	touch database/database.sqlite

refresh-db:
	touch database/database.sqlite
	php artisan migrate:refresh --seed
