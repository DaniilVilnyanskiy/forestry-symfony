### Основные команды
```php
// UP
docker-compose up -d --build --force-recreate
// DOWN
docker-compose down
// BASH
docker exec -it forestry-symfony_php-fpm /bin/bash
// START RR
docker exec -it forestry-symfony_php-fpm vendor/bin/rr get --location ../bin/
docker exec -it forestry-symfony_php-fpm ../bin/rr serve -c .rr.dev.yaml
```
### Первый запуск проекта

```php
cp .env.test .env
docker-compose up --build -d
```

Может также понадобиться:
```php
cd app
cp .env.test .env
```

Чтобы войти в любой из контейнеров, делаем следующее:
```php
docker exec -it <container_name> bash
```

Логи контейнера:
```php
docker logs <container_name>
```




