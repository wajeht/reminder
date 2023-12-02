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
	rm -rf ./vendor
	rm -rf ./node_modules
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

restart:
	git pull
	rm -rf ./vendor
	rm -rf ./node_modules
	composer install
	npm install
	rm -rf storage/app/public/*
	rm database/database.sqlite
	touch database/database.sqlite
	php artisan migrate:refresh --seed
	npm run dev

refresh-db:
	rm -rf storage/app/public/*
	rm database/database.sqlite
	touch database/database.sqlite
	php artisan migrate:refresh --seed
