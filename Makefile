lint:
	npm run lint
	./vendor/bin/phpstan analyse . --memory-limit=2G

clear:
	php artisan config:clear
	php artisan view:clear
	php artisan route:clear
	php artisan cache:clear

pint:
	./vendor/bin/pint

link:
	php artisan storage:link

deploy:
	./deploy.sh

install:
	composer install
	npm install

format:
	npm run format
	./vendor/bin/pint

test-ui:
	npm run test

test-api:
	php artisan test

test:
	npm run test
	php artisan test

build:
	npm run build:prod

ide:
	php artisan clear-compiled
	php artisan ide-helper:generate
	php artisan ide-helper:models

db:
	touch database/database.sqlite

refresh-db:
	rm database/database.sqlite
	touch database/database.sqlite
	php artisan migrate:refresh --seed
