lint:
	npm run lint

install:
	composer install
	npm install

format:
	npm run format

build:
	npm run format

db:
	touch database/database.sqlite

refresh-db:
	touch database/database.sqlite
	php artisan migrate:refresh --seed
