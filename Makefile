COMPOSE_PROJECT_NAME := split
COMPOSE_FILE := ./docker/docker-compose.dev.yml

start:
	docker-compose -p ${COMPOSE_PROJECT_NAME} -f ${COMPOSE_FILE} up -d

stop:
	docker-compose -p ${COMPOSE_PROJECT_NAME} -f ${COMPOSE_FILE} down

build:
	docker-compose -p ${COMPOSE_PROJECT_NAME} -f ${COMPOSE_FILE} build

ps:
	docker-compose -p ${COMPOSE_PROJECT_NAME} -f ${COMPOSE_FILE} ps

exec:
	docker-compose -p ${COMPOSE_PROJECT_NAME} -f ${COMPOSE_FILE} exec php bash
