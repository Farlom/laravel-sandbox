#!make
include .env

DOCKER_COMPOSE=docker compose
DOCKER_EXEC=docker exec ${PROJECT_NAME}_php

CURRENT_UID := $(shell id -u)
CURRENT_USER := $(shell whoami)

export CURRENT_UID
export CURRENT_USER

.PHONY: init
init: build up composer migrate optimize
#admin db_seed optimize

.PHONY: up
up:
	$(DOCKER_COMPOSE) up -d --wait

.PHONY: down
down:
	$(DOCKER_COMPOSE) down

.PHONY: restart
restart: down up

.PHONY: build
build:
	$(DOCKER_COMPOSE) build --force-rm

.PHONY: composer
composer:
	$(DOCKER_EXEC) composer install -n

.PHONY: yarn_install
yarn_install:
	$(DOCKER_EXEC) yarn

.PHONY: yarn_prod
yarn_prod:
	$(DOCKER_EXEC) yarn prod

.PHONY: yarn
yarn: yarn_install yarn_prod

.PHONY: optimize
optimize:
	$(DOCKER_EXEC) php artisan cache:clear
	$(DOCKER_EXEC) php artisan optimize
	$(DOCKER_EXEC) php artisan storage:link

.PHONY: exec
exec:
	docker exec -it ${PROJECT_NAME}_php bash

.PHONY: migrate
migrate:
	$(DOCKER_EXEC) php artisan migrate --force

.PHONY: db_seed
db_seed:
	$(DOCKER_EXEC) php artisan db:seed

.PHONY: admin
admin:
	$(DOCKER_EXEC) php artisan admin:install
