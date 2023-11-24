lint:
	npm run lint

format:
	npm run format

build:
	npm run format

refresh-db:
	php artisan migrate:refresh --seed
