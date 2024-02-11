@echo off

set DOCKER_COMPOSE=docker-compose.yml

rem Проверка параметра
IF "%1" == "start" (
    call :start
) ELSE IF "%1" == "stop" (
    call :stop
) ELSE IF "%1" == "bash" (
    call :bash
) ELSE IF "%1" == "serve" (
     call :serve
) ELSE (
    echo Неизвестный параметр
)

goto :eof

:start
docker-compose -f %DOCKER_COMPOSE% up -d --build --force-recreate
goto :eof

:stop
docker-compose -f %DOCKER_COMPOSE% down
goto :eof

:bash
docker exec -it forestry-symfony_php-fpm /bin/bash
goto :eof

:serve
docker exec -it forestry-symfony_php-fpm vendor/bin/rr get --location ../bin/
docker exec -it forestry-symfony_php-fpm ../bin/rr serve -c .rr.dev.yaml
goto :eof
