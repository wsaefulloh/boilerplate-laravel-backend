.PHONY: setup serve octane migrate seed test lint pint docker-up docker-down docker-build

setup:
	composer install
	cp -n .env.example .env || true
	php artisan key:generate
	touch database/database.sqlite
	php artisan migrate:fresh --seed

serve:
	php artisan serve

octane:
	php artisan octane:start --server=frankenphp

migrate:
	php artisan migrate

seed:
	php artisan db:seed

fresh:
	php artisan migrate:fresh --seed

test:
	php artisan test

lint:
	./vendor/bin/pint

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down

docker-build:
	docker-compose up -d --build
