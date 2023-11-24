lint:
	npm run lint

format:
	npm run format

build:
	npm run format

db:
	touch database/database.sqlite

refresh-db:
	php artisan migrate:refresh --seed
