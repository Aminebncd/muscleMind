SHELL := /bin/sh

.PHONY: up down build logs bash cc migrate fixtures test assets

up:
	docker compose up -d

down:
	docker compose down

build:
	docker compose build --pull

logs:
	docker compose logs -f --tail=200

bash:
	docker compose exec php sh

cc:
	docker compose exec php php bin/console cache:clear

migrate:
	docker compose exec php php bin/console doctrine:migrations:migrate --no-interaction

fixtures:
	docker compose exec php php bin/console doctrine:fixtures:load --no-interaction

test:
	docker compose exec php ./vendor/bin/phpunit

assets:
	docker compose exec node npm run build
