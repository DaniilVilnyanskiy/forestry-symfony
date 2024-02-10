DOCKER_COMPOSE = docker-compose.yml

.PHONY: stop
stop:
	docker-compose -f ${DOCKER_COMPOSE} down

.PHONY: start
start:
	docker-compose -f ${DOCKER_COMPOSE} up -d --build --force-recreate

serve:
	docker exec -it forestry-symfony_php-fpm vendor/bin/rr get --location ../bin/ &&
	docker exec -it forestry-symfony_php-fpm ../bin/rr serve -c .rr.dev.yaml

bash:
	docker exec -it forestry-symfony_php-fpm /bin/bash

restart:
	make stop
	make start
